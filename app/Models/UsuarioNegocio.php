<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UsuarioNegocio extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios_negocio';
    protected $fillable = ['nombre', 'correo', 'password', 'rol'];
}
