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
        // Verificar si la columna ya existe (puede estar en create_rooms_table)
        if (!Schema::hasColumn('rooms', 'room_type')) {
            Schema::table('rooms', function (Blueprint $table) {
                $table->string('room_type')->default('simple')->after('name');
                // Tipos: simple, doble, matrimonial, triple, cuadruple
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('room_type');
        });
    }
};
