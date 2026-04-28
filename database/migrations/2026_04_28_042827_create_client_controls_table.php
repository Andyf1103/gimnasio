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
        Schema::create('client_controls', function (Blueprint $table) {
            $table->id();
            $table->decimal('peso_inicial', 5, 2);
            $table->decimal('peso_final', 5, 2);
            $table->decimal('talla_usuario', 5, 2);
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_controls');
    }
};
