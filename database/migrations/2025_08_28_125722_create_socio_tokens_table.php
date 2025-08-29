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
        Schema::create('socio_tokens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('socio_id');  // ID del socio (de tu SP)
            $table->string('token')->unique();       // Token único
            $table->timestamp('expires_at'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socio_tokens');
    }
};
