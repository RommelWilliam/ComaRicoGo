<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ordenes', function (Blueprint $table) {
            $table->unsignedBigInteger('favorito_origen_id')->nullable()->after('estado');
            // (Opcional) índice para consultas rápidas:
            $table->index('favorito_origen_id', 'ordenes_favorito_origen_idx');
        });
    }

    public function down(): void
    {
        Schema::table('ordenes', function (Blueprint $table) {
            $table->dropIndex('ordenes_favorito_origen_idx');
            $table->dropColumn('favorito_origen_id');
        });
    }
};
