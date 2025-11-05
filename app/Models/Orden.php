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
        'fecha_finalizado',
        'calificacion',
    ];

    public $platillosVista;//Platillos para retornar a las vistas
  
public function cliente()
{
    return $this->belongsTo(Cliente::class);
}

public function cocinero()
{
    return $this->belongsTo(UsuarioNegocio::class, 'cocinero_id');
}

public function platillos()
{
    return $this->belongsToMany(Platillo::class, 'orden_platillo')
                ->withPivot('cantidad')
                ->withTimestamps();
}






}
