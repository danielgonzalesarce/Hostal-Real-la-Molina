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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('amenities')->nullable();
            $table->integer('capacity')->default(2);
            $table->decimal('price_per_night', 10, 2);
            $table->boolean('is_available')->default(true);
            $table->integer('sort_order')->default(0);
            $table->string('room_type')->nullable();
            $table->timestamps();
            
            // Índices para optimizar queries frecuentes
            $table->index('is_available');
            $table->index('sort_order');
            $table->index('price_per_night');
            $table->index('room_type');
            $table->index(['is_available', 'sort_order']);
            $table->index(['is_available', 'price_per_night']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
