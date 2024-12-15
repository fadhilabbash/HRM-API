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
        Schema::create('time_offs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->date('start_date');  // Track just the date of the time off
            $table->integer('start_hour');  // Start hour of the time off (e.g., 9 AM)
            $table->integer('end_hour');  // End hour of the time off (e.g., 1 PM or 5 PM)
            $table->integer('total_hours');  // Total hours of time off during that period
            $table->string('type');  // Type of time off (vacation, sick leave, etc.)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_offs');
    }
};
