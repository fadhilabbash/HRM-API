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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name');
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->text('address');
            $table->string('mobile')->unique();
            $table->string('emergency_mobile')->nullable();
            $table->string('email')->unique();
            $table->string('badge_number')->unique();
            $table->date('hiring_date');
            $table->enum('education_grade', [
                'none',
                'primary',
                'secondary',
                'high_school',
                'bachelor',
                'master',
                'doctorate',
                'other'
            ])->nullable();
            $table->foreignId('department_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('position_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('type', ['permanent', 'contract', 'intern']);
            $table->decimal('salary', 15, 2);
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
