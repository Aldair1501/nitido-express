<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Rol;
class NitidoRolesSeeder extends Seeder{public function run():void{Rol::firstOrCreate(['nombre'=>'cliente'],['descripcion'=>'Cliente de la tienda']);Rol::firstOrCreate(['nombre'=>'administrador'],['descripcion'=>'Gestión del negocio']);}}
