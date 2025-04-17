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
        Schema::create('thesis_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users');
            $table->string('title_en');
            $table->string('title_hr');
            $table->text('task');
            $table->enum('study_type', ['professional', 'undergraduate', 'graduate']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_tasks');
    }
};
