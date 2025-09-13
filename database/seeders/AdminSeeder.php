<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        




class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('usuarios_negocio')->insert([
            'nombre' => 'Administrador',
            'correo' => 'admin@ejemplo.com',
            'password' => Hash::make('12345678'), // contraseña segura
            'rol_id' => 1, // 1 = administrador
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
    }
}
