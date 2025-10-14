<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reportes_cocina', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cocinero_id')->constrained('usuarios_negocio')->onDelete('cascade');
            $table->text('descripcion');
            $table->timestamp('fecha_reporte')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reportes_cocina');
    }
};

