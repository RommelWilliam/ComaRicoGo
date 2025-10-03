<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatilloOrden extends Model
{
    use HasFactory;

    protected $table = 'orden_platillo';

    protected $fillable = [
        'id',
        'orden_id',
        'platillo_id',
        'cantidad',
    ];
}
