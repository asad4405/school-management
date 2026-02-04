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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string(column: 'teacher_code')->unique();
            $table->string(column: 'designation');
            $table->string(column: 'qualification')->nullable();
            $table->string(column: 'address')->nullable();
            $table->string(column: 'gender')->nullable();
            $table->string(column: 'dob')->nullable();
            $table->string(column: 'religion')->nullable();
            $table->string(column: 'nid')->nullable();
            $table->date(column: 'join_date')->nullable();
            $table->string(column: 'cv')->nullable();
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
