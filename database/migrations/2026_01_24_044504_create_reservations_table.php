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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->string('guest_name');
            $table->string('guest_email');
            $table->string('guest_phone')->nullable();
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('guests');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->text('special_requests')->nullable();
            $table->timestamps();
            
            // Índices para optimizar búsquedas de reservas
            $table->index('room_id');
            $table->index('status');
            $table->index('check_in');
            $table->index('check_out');
            $table->index(['room_id', 'check_in', 'check_out']);
            $table->index(['status', 'check_in']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
