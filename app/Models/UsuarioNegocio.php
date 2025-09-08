<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioNegocio extends Model
{
    use HasFactory;

    protected $table = 'usuarios_negocio';
    protected $fillable = ['nombre', 'correo', 'password', 'rol'];
}
