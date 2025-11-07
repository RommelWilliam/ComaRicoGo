<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;

    protected $table = 'favoritos';

    protected $fillable = [
        'cliente_id',
        'nombre',
        'source_order_id',
    ];

    protected $casts = [
        'cliente_id'      => 'integer',
        'source_order_id' => 'integer',
    ];

    // --- Relaciones ---

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function items()
    {
        // Ítems snapshot del favorito
        return $this->hasMany(FavoritoPlatillo::class, 'favorito_id');
    }

    public function platillos()
    {
        // Conveniencia para acceder directo a los platillos con cantidad/nota
        return $this->belongsToMany(Platillo::class, 'favorito_platillo', 'favorito_id', 'platillo_id')
                    ->withPivot(['cantidad', 'nota'])
                    ->withTimestamps();
    }
}
