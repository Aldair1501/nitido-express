<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = ['categoria_id', 'sku', 'nombre', 'slug', 'descripcion', 'precio', 'stock', 'activo'];
    protected function casts(): array { return ['precio' => 'decimal:2', 'stock' => 'integer', 'activo' => 'boolean']; }
    public function categoria() { return $this->belongsTo(Categoria::class); }
    public function imagenes() { return $this->hasMany(ProductoImagen::class); }
    public function carritoItems() { return $this->hasMany(CarritoItem::class); }
}
