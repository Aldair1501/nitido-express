<?php
namespace App\Http\Controllers;
use App\Models\{User,Rol};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Hash,DB};
class CuentaController extends Controller{
 public function loginForm(){return view('cuenta.login');}
 public function registerForm(){return view('cuenta.registro');}
 public function login(Request $request){$data=$request->validate(['email'=>'required|email','password'=>'required|string']);if(!Auth::attempt([...$data,'activo'=>true]))return back()->withErrors(['email'=>'Credenciales incorrectas o cuenta inactiva.'])->onlyInput('email');$request->session()->regenerate();return redirect()->intended(route('tienda.index'));}
 public function register(Request $request){$d=$request->validate(['name'=>'required|string|max:150','email'=>'required|email|max:255|unique:users,email','password'=>'required|string|min:10|confirmed']);
  $user=DB::transaction(function()use($d){$rol=Rol::where('nombre','cliente')->firstOrFail();$u=new User();$u->name=$d['name'];$u->email=$d['email'];$u->password=Hash::make($d['password']);$u->rol_id=$rol->id;$u->activo=true;$u->save();return $u;});Auth::login($user);$request->session()->regenerate();return redirect()->route('tienda.index')->with('ok','Tu cuenta está lista.');}
 public function logout(Request $request){Auth::logout();$request->session()->invalidate();$request->session()->regenerateToken();return redirect()->route('tienda.index');}
}
