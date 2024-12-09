<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documentos_adjunto', function (Blueprint $table) {
            $table->id();
            $table->string('ruta_documento')->nullable(); // Columna para almacenar la ruta del documento
            $table->boolean('estado')->default(true);
            $table->foreignId('solicitud_id')->constrained('solicitudes')->onDelete('cascade');
            $table->foreignId('tipo_documento_id')->constrained('tipos_documentos_adjunto')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_adjunto');
    }
};
