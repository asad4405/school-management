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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string(column: 'student_id')->unique();
            $table->string('roll_no', 6)->unique();
            $table->string('reg_no', 10)->unique();
            $table->string(column: 'address')->nullable();
            $table->string(column: 'class_roll')->nullable();
            $table->string(column: 'gender')->nullable();
            $table->string(column: 'dob')->nullable();
            $table->string(column: 'religion')->nullable();
            $table->string(column: 'birth_id')->nullable();
            $table->string(column: 'guardian_name')->nullable();
            $table->string(column: 'guardian_phone')->nullable();
            $table->date(column: 'issue_date')->nullable();
            $table->date(column: 'expire_date')->nullable();
            $table->integer(column: 'position')->nullable();
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
