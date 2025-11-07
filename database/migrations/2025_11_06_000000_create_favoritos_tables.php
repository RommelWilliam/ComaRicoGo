<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabla principal de favoritos
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();

            // Dueño del favorito
            $table->foreignId('cliente_id')
                  ->constrained('clientes')
                  ->onDelete('cascade');

            // (Opcional) nombre amigable que el cliente puede ponerle
            $table->string('nombre')->nullable();

            // (Opcional) referencia a la orden desde la que se creó el favorito (solo para auditoría)
            $table->foreignId('source_order_id')
                  ->nullable()
                  ->constrained('ordenes')
                  ->nullOnDelete();

            $table->timestamps();

            // Índices útiles
            $table->index(['cliente_id', 'created_at']);
        });

        // Ítems (snapshots) de un favorito
        Schema::create('favorito_platillo', function (Blueprint $table) {
            $table->id();

            $table->foreignId('favorito_id')
                  ->constrained('favoritos')
                  ->onDelete('cascade');

            $table->foreignId('platillo_id')
                  ->constrained('platillos')
                  ->onDelete('cascade');

            $table->integer('cantidad')->default(1);

            // (Opcional) nota específica de ese platillo en el favorito (si la manejas en órdenes)
            $table->text('nota')->nullable();

            $table->timestamps();

            $table->unique(['favorito_id', 'platillo_id'], 'favorito_platillo_unique');
        });
    }

    public function down(): void
    {
        // Borrar primero la hija
        Schema::dropIfExists('favorito_platillo');
        Schema::dropIfExists('favoritos');
    }
};
