<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
{
    Schema::table('ordenes', function (Blueprint $table) {
        // Agregar columnas solo si NO existen
        if (!Schema::hasColumn('ordenes', 'cocinero_id')) {
            $table->unsignedBigInteger('cocinero_id')->nullable()->after('cliente_id');
        }
        if (!Schema::hasColumn('ordenes', 'estado')) {
            $table->enum('estado', ['pendiente', 'en_proceso', 'finalizada'])
                  ->default('pendiente')
                  ->after('total');
        }

        // Agregar FK si no existe (MySQL)
        // Nota: Schema no trae helper para FKs existentes. Puedes hacer un check simple:
        $conn = config('database.connections.'.config('database.default').'.driver');
        if ($conn === 'mysql') {
            $fkExists = DB::selectOne("
                SELECT CONSTRAINT_NAME
                FROM information_schema.KEY_COLUMN_USAGE
                WHERE TABLE_SCHEMA = DATABASE()
                  AND TABLE_NAME = 'ordenes'
                  AND COLUMN_NAME = 'cocinero_id'
                  AND REFERENCED_TABLE_NAME = 'usuarios_negocio'
            ");
            if (!$fkExists) {
                $table->foreign('cocinero_id')
                      ->references('id')->on('usuarios_negocio')
                      ->nullOnDelete();
            }
        }
    });
}

    public function down()
    {
        Schema::table('ordenes', function (Blueprint $table) {
            $table->dropForeign(['cocinero_id']);
            $table->dropColumn(['cocinero_id', 'estado']);
        });
    }
};
