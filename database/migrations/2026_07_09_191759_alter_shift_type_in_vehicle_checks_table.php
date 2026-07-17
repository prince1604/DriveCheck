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
        Schema::table('vehicle_checks', function (Blueprint $table) {
            $table->string('shift_type')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_checks', function (Blueprint $table) {
            // Not easily reversible to ENUM if new values are added, but we can try mapping
            // Note: In SQLite changing to enum is not supported, so we just leave it as string
            // $table->enum('shift_type', ['Day', 'Night'])->change();
        });
    }
};
