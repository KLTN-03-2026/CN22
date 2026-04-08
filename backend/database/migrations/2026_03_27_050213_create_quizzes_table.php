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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('course_id')->nullable();
            $table->integer('lesson_id')->nullable();
            $table->integer('time_limit')->default(0); // time limit in minutes, 0 means no limit
            $table->decimal('total_score', 8, 2)->default(0);
            $table->decimal('pass_score', 8, 2)->default(0);
            $table->integer('max_times')->default(0); // 0 means unlimited
            $table->boolean('suffle_questions')->default(false);
            $table->integer('is_active')->default(1); // 0: inactive, 1: active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
