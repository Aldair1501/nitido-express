<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 'auditoria';
    protected $fillable = ['user_id', 'accion', 'entidad', 'entidad_id', 'detalles', 'ip_address'];
    protected function casts(): array { return ['detalles' => 'array']; }
    public function user() { return $this->belongsTo(User::class); }
}
