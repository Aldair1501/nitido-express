<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['numero_pedido', 'user_id', 'direccion_entrega', 'subtotal', 'costo_envio', 'total', 'estado'];
    protected function casts(): array { return ['direccion_entrega' => 'array', 'subtotal' => 'decimal:2', 'costo_envio' => 'decimal:2', 'total' => 'decimal:2']; }
    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(PedidoItem::class); }
    public function pagos() { return $this->hasMany(Pago::class); }
}
