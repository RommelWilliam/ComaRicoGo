<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platillo extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre',
        'cantidad',
        'disponible',
        'descripcion',
        'precio',
        'categoria',
        'img',
    ];

    public function ordenes()
{
    return $this->belongsToMany(Orden::class, 'orden_platillo')
                ->withPivot('cantidad')
                ->withTimestamps();
}

}
