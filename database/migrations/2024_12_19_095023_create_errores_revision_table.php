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
        Schema::create('errores_revision', function (Blueprint $table) {
            $table->id();
            $table->string('comentario')->nullable();
            $table->foreignId('usuario_revisor_id')->nullable()->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('usuario_error_id')->nullable()->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('solicitud_id')->nullable()->constrained('solicitudes')->onDelete('cascade');
            $table->foreignId('tipo_error_id')->nullable()->constrained('tipo_errores_revision')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('errores_revision');
    }
};
