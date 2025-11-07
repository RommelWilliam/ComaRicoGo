<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritosSeeder extends Seeder
{
    public function run(): void
    {
        // Busca un cliente cualquiera
        $cliente = DB::table('clientes')->select('id')->orderBy('id')->first();
        if (!$cliente) return;

        // Toma 2 platillos existentes 
        $platillos = DB::table('platillos')->select('id')->limit(2)->get();
        if ($platillos->count() === 0) return;

        // Crea el favorito
        $favoritoId = DB::table('favoritos')->insertGetId([
            'cliente_id' => $cliente->id,
            'nombre' => 'Mi combo favorito',
            'source_order_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($platillos as $p) {
            DB::table('favorito_platillo')->insert([
                'favorito_id' => $favoritoId,
                'platillo_id' => $p->id,
                'cantidad' => 1,
                'nota' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
