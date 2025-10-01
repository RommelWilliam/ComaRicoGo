<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ordenes', function (Blueprint $table) {
            // cocinero asignado (nullable porque al inicio ninguna orden lo tiene)
            $table->unsignedBigInteger('cocinero_id')->nullable()->after('cliente_id');

            // estado de la orden
            $table->enum('estado', ['pendiente', 'en_proceso', 'finalizada'])
                  ->default('pendiente')
                  ->after('total');

            // foreign key al cocinero
            $table->foreign('cocinero_id')
                  ->references('id')->on('usuarios_negocio')
                  ->onDelete('set null');
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
