<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $fillable = ['pedido_id', 'metodo', 'monto', 'estado', 'referencia', 'fecha_pago'];
    protected function casts(): array { return ['monto' => 'decimal:2', 'fecha_pago' => 'datetime']; }
    public function pedido() { return $this->belongsTo(Pedido::class); }
}
