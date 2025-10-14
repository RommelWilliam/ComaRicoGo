<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteCocina extends Model
{
    protected $table = 'reportes_cocina';

    protected $fillable = [
        'cocinero_id',
        'descripcion',
        'fecha_reporte'
    ];

    
    protected $casts = [
        'fecha_reporte' => 'datetime',
    ];

    public $timestamps = false;
}
