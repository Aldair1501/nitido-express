<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    
    // Relación con roles
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // Relación con direcciones
    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }

    // Relación con el carrito
    public function carrito()
    {
        return $this->hasOne(Carrito::class);
    }

    // Relación con pedidos
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

}
