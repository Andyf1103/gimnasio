<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagos_membresias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membership_id')->constrained('memberships')->onDelete('cascade');
            $table->decimal('monto', 10, 2);
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('cascade');
            $table->string('comprobante', 255)->nullable();
            $table->date('fecha_pago');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos_membresias');
    }
};