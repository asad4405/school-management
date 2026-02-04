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
        Schema::create('teacher_assignments', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->nullable();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->integer('class_id');
            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->json('subject_id');
            $table->integer('position')->nullable();
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_assignments');
    }
};
