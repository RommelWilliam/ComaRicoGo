<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'ordenes';
    use HasFactory;
     protected $fillable = [
        'cliente_id',
        'total',
        'nota',
        'contacto_nombre',
        'contacto_telefono',
    ];
    public function platillos()
{
    return $this->belongsToMany(Platillo::class, 'orden_platillo')->withPivot('cantidad');
}
}
