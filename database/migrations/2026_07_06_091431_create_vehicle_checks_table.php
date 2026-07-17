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
        Schema::create('vehicle_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('checking_point_id')->constrained('checking_points')->onDelete('cascade');
            $table->string('person_name');
            $table->date('shift_date');
            $table->enum('shift_type', ['Day', 'Night']);
            $table->string('vehicle_no');
            $table->string('employee_id_no')->nullable();
            $table->string('vehicle_photo')->nullable();
            $table->time('checking_time');
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_checks');
    }
};
