<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();

            // Relación con cliente
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');

            // Relación con cocinero (puede ser null hasta que alguien se asigne)
            $table->foreignId('cocinero_id')->nullable()->constrained('usuarios_negocio')->onDelete('set null');

            // Datos de la orden
            $table->decimal('total', 8, 2)->default(0);
            $table->text('nota')->nullable();

            // Estado de la orden
            $table->enum('estado', ['pendiente', 'en_proceso', 'finalizada'])->default('pendiente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
};
