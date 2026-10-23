<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class NitidoFotosDemoSeeder extends Seeder{
 public function run():void{
  // Fotografía real ilustrativa de Unsplash, NO representa exactamente los SKU de demostración.
  $fotos=[
   'MOU-001'=>'https://images.unsplash.com/photo-1527814050087-3793815479db?w=700&auto=format&fit=crop&q=80',
   'AUD-001'=>'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=700&auto=format&fit=crop&q=80',
   'TEC-001'=>'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=700&auto=format&fit=crop&q=80',
   'BOC-001'=>'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=700&auto=format&fit=crop&q=80',
   'MOC-001'=>'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=700&auto=format&fit=crop&q=80',
   'TER-001'=>'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=700&auto=format&fit=crop&q=80',
   'REL-001'=>'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=700&auto=format&fit=crop&q=80',
   'GOR-001'=>'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=700&auto=format&fit=crop&q=80',
   'LAM-001'=>'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=700&auto=format&fit=crop&q=80',
   'ORG-001'=>'https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=700&auto=format&fit=crop&q=80',
   'TAZ-001'=>'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=700&auto=format&fit=crop&q=80',
   'PLA-001'=>'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=700&auto=format&fit=crop&q=80',
  ];
  foreach($fotos as $sku=>$url){$id=DB::table('productos')->where('sku',$sku)->value('id');if(!$id)continue;$record=DB::table('producto_imagenes')->where('producto_id',$id)->where('principal',true)->first();if($record && str_starts_with($record->ruta,'demo/'))DB::table('producto_imagenes')->where('id',$record->id)->update(['ruta'=>$url,'updated_at'=>now()]);}
 }
}
