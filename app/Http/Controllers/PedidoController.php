<?php
namespace App\Http\Controllers;
use App\Models\{Producto,Pedido,Pago};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
class PedidoController extends Controller{
 public function form(Request $request){if(!count($request->session()->get('carrito',[])))return redirect()->route('carrito.index');return view('pedidos.checkout');}
 public function store(Request $request){
  $d=$request->validate(['destinatario'=>'required|string|max:150','telefono'=>'required|regex:/^(\+?502)?[2-7][0-9]{7}$/','departamento'=>'required|string|max:100','municipio'=>'required|string|max:100','direccion'=>'required|string|max:500','referencia'=>'nullable|string|max:300','metodo'=>'required|in:transferencia,contraentrega']);
  $cart=$request->session()->get('carrito',[]);if(!$cart)return redirect()->route('carrito.index');
  $pedido=DB::transaction(function()use($cart,$d,$request){
   $productos=Producto::whereIn('id',array_keys($cart))->orderBy('id')->lockForUpdate()->get()->keyBy('id');$subtotal=0;$lineas=[];
   foreach($cart as $id=>$cantidad){$p=$productos->get($id);if(!$p||!$p->activo||$p->stock<$cantidad||$cantidad<1)throw ValidationException::withMessages(['carrito'=>'Un producto no tiene suficientes existencias. Regresa al carrito.']);$precio=(int)round(((float)$p->precio)*100);$subtotal+=$precio*$cantidad;$lineas[]=[$p,$cantidad,$precio];}
   $envio=0; // Costo sujeto a confirmación manual por el comercio.
   $pedido=Pedido::create(['numero_pedido'=>'NE-'.strtoupper(Str::random(10)),'user_id'=>$request->user()->id,'direccion_entrega'=>array_intersect_key($d,array_flip(['destinatario','telefono','departamento','municipio','direccion','referencia'])),'subtotal'=>number_format($subtotal/100,2,'.',''),'costo_envio'=>number_format($envio/100,2,'.',''),'total'=>number_format(($subtotal+$envio)/100,2,'.',''),'estado'=>'pendiente']);
   foreach($lineas as [$p,$cantidad,$precio]){$pedido->items()->create(['producto_id'=>$p->id,'nombre_producto'=>$p->nombre,'sku_producto'=>$p->sku,'cantidad'=>$cantidad,'precio_unitario'=>number_format($precio/100,2,'.',''),'subtotal'=>number_format($precio*$cantidad/100,2,'.','')]);$p->decrement('stock',$cantidad);}
   Pago::create(['pedido_id'=>$pedido->id,'metodo'=>$d['metodo'],'monto'=>$pedido->total,'estado'=>'pendiente']);return $pedido;
  });
  $request->session()->forget('carrito');return redirect()->route('pedidos.show',$pedido)->with('ok','Pedido registrado. El comercio debe confirmar el pago y envío.');
 }
 public function index(Request $request){$pedidos=Pedido::where('user_id',$request->user()->id)->latest()->paginate(15);return view('pedidos.index',compact('pedidos'));}
 public function show(Request $request,Pedido $pedido){abort_unless($pedido->user_id===$request->user()->id || $request->user()->rol?->nombre==='administrador',403);$pedido->load('items','pagos');return view('pedidos.show',compact('pedido'));}
}
