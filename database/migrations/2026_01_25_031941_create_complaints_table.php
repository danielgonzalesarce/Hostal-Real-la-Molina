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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('claimant_name');
            $table->string('claimant_dni', 20);
            $table->string('claimant_phone', 20);
            $table->string('claimant_email');
            $table->text('claimant_address')->nullable();
            $table->text('complaint_description');
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'dismissed'])->default('pending');
            $table->text('response')->nullable();
            $table->timestamp('response_date')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
