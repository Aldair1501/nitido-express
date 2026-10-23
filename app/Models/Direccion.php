<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direcciones';
    protected $fillable = ['user_id', 'destinatario', 'telefono', 'departamento', 'municipio', 'direccion', 'referencia', 'predeterminada'];
    protected function casts(): array { return ['predeterminada' => 'boolean']; }
    public function user() { return $this->belongsTo(User::class); }
}
