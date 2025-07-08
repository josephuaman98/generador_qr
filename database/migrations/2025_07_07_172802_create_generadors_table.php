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
        Schema::create('generadors', function (Blueprint $table) {
            $table->id();
            $table->string('imagen_ruta_qr');
            $table->text('link_qr');
            $table->text('descripcion')->nullable();
            $table->string('user_id');
            $table->string('estado');
            $table->timestamps(6);  //fecha_creacion
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generadors');
    }
};
