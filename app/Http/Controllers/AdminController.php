<?php
namespace App\Http\Controllers;
use App\Models\{Producto,Categoria,Pedido,ProductoImagen};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
class AdminController extends Controller{
 private function check(Request $r):void{abort_unless($r->user()?->activo && $r->user()?->rol?->nombre==='administrador',403);}
 
public function index(Request $r)
{
    $this->check($r);

    $productos = Producto::count();

    $pedidos = Pedido::count();

    $pendientes = Pedido::where('estado', 'pendiente')->count();

    $activos = Producto::where('activo', true)->count();

    $recientes = Pedido::select('id', 'estado', 'created_at')
        ->latest()
        ->take(6)
        ->get();

    return view('admin.index', compact(
        'productos',
        'pedidos',
        'pendientes',
        'activos',
        'recientes'
    ));
}

 public function products(Request $r){$this->check($r);$productos=Producto::with('categoria')->latest()->paginate(20);return view('admin.products',compact('productos'));}
 public function create(Request $r){$this->check($r);$categorias=Categoria::orderBy('nombre')->get();return view('admin.form',['producto'=>new Producto(),'categorias'=>$categorias]);}
 public function edit(Request $r,Producto $producto){$this->check($r);$categorias=Categoria::orderBy('nombre')->get();$producto->load('imagenes');return view('admin.form',compact('producto','categorias'));}
 private function rules(?Producto $producto=null):array{return ['categoria_id'=>'required|exists:categorias,id','nombre'=>'required|string|max:150','sku'=>['required','string','max:50',Rule::unique('productos','sku')->ignore($producto?->id)],'descripcion'=>'nullable|string|max:2000','precio'=>'required|numeric|min:0.01|max:99999999','stock'=>'required|integer|min:0|max:1000000','foto'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:3072'];}
 public function store(Request $r){$this->check($r);$d=$r->validate($this->rules());$foto=$d['foto']??null;unset($d['foto']);$d['slug']=Str::slug($d['nombre']).'-'.Str::lower(Str::random(5));$d['activo']=true;$p=Producto::create($d);$this->image($p,$foto);return redirect()->route('admin.products')->with('ok','Producto creado.');}
 public function update(Request $r,Producto $producto){$this->check($r);$d=$r->validate($this->rules($producto));$foto=$d['foto']??null;unset($d['foto']);$producto->update($d);$this->image($producto,$foto);return redirect()->route('admin.products')->with('ok','Producto actualizado.');}
 private function image(Producto $p,$foto):void{if(!$foto)return;$ruta=$foto->store('productos','public');$p->imagenes()->update(['principal'=>false]);$p->imagenes()->create(['ruta'=>$ruta,'principal'=>true,'orden'=>0]);}
 public function disable(Request $r,Producto $producto){$this->check($r);$producto->update(['activo'=>false]);return back()->with('ok','Producto desactivado (no se eliminaron ventas).');}
 public function orders(Request $r){$this->check($r);$pedidos=Pedido::with('user')->latest()->paginate(20);return view('admin.orders',compact('pedidos'));}
 public function orderStatus(Request $r,Pedido $pedido){$this->check($r);$d=$r->validate(['estado'=>'required|in:pendiente,confirmado,enviado,entregado,cancelado']);if($pedido->estado==='cancelado'&&$d['estado']!=='cancelado')return back()->withErrors(['estado'=>'Un pedido cancelado no puede reactivarse manualmente.']);if($d['estado']==='cancelado'&&$pedido->estado!=='cancelado')\Illuminate\Support\Facades\DB::transaction(function()use($pedido){foreach($pedido->items as $i){if($i->producto_id)Producto::whereKey($i->producto_id)->increment('stock',$i->cantidad);} $pedido->update(['estado'=>'cancelado']);});else $pedido->update(['estado'=>$d['estado']]);return back()->with('ok','Estado actualizado.');}
}
