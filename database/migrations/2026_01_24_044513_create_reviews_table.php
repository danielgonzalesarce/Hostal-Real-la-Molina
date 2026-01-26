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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('room_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('guest_name');
            $table->string('guest_email')->nullable();
            $table->integer('rating');
            $table->text('comment');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            
            // Índices para optimizar queries de reseñas
            $table->index('room_id');
            $table->index('is_approved');
            $table->index('is_featured');
            $table->index('rating');
            $table->index(['room_id', 'is_approved']);
            $table->index(['is_featured', 'is_approved']);
            $table->index(['user_id', 'room_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
