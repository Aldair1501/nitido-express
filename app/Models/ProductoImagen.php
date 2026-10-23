<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoImagen extends Model
{
    protected $table = 'producto_imagenes';
    protected $fillable = ['producto_id', 'ruta', 'principal', 'orden'];
    protected function casts(): array { return ['principal' => 'boolean', 'orden' => 'integer']; }
    public function producto() { return $this->belongsTo(Producto::class); }
}
