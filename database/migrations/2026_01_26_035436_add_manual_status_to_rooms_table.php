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
        Schema::table('rooms', function (Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'manual_status')) {
                $table->enum('manual_status', ['available', 'occupied'])->nullable()->after('is_available')->comment('Estado manual: null=automático, available=libre, occupied=ocupada');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            if (Schema::hasColumn('rooms', 'manual_status')) {
                $table->dropColumn('manual_status');
            }
        });
    }
};
