<?php
namespace App\Console\Commands;
use App\Models\{User,Rol};
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
class NitidoCrearAdmin extends Command{
 protected $signature='nitido:crear-admin';
 protected $description='Crear o promover una cuenta administradora desde la consola local';
 public function handle():int{
  $nombre=$this->ask('Nombre del administrador');$correo=$this->ask('Correo electrónico');$pass=$this->secret('Contraseña fuerte (mínimo 12 caracteres)');
  if(!filter_var($correo,FILTER_VALIDATE_EMAIL)||mb_strlen((string)$pass)<12){$this->error('Correo inválido o contraseña menor de 12 caracteres.');return self::FAILURE;}
  $rol=Rol::firstOrCreate(['nombre'=>'administrador'],['descripcion'=>'Administración de la tienda']);
  $user=User::where('email',$correo)->first();
  if($user){if(!$this->confirm('La cuenta existe. ¿Asignarle rol administrador y cambiar contraseña?',false))return self::FAILURE;}
  else {$user=new User();$user->email=$correo;}
  $user->name=$nombre;$user->password=Hash::make($pass);$user->rol_id=$rol->id;$user->activo=true;$user->save();$this->info('Administrador listo.');return self::SUCCESS;
 }
}
