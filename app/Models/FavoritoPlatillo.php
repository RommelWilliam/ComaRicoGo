<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoritoPlatillo extends Model
{
    use HasFactory;

    protected $table = 'favorito_platillo';

    protected $fillable = [
        'favorito_id',
        'platillo_id',
        'cantidad',
        'nota',
    ];

    protected $casts = [
        'favorito_id' => 'integer',
        'platillo_id' => 'integer',
        'cantidad'    => 'integer',
    ];

    // --- Relaciones ---

    public function favorito()
    {
        return $this->belongsTo(Favorito::class);
    }

    public function platillo()
    {
        return $this->belongsTo(Platillo::class);
    }
}
