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
// answers (id, question_id, content, is_correct)
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_id');
            $table->string('content');
            $table->boolean('is_correct')->default(false); // for multiple choice questions
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
