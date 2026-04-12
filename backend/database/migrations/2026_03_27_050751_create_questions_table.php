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
// questions (id, quiz_id, content, type (mcq/code))
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quiz_id');
            $table->string('content');
            $table->integer('type'); // multiple_choice, short_answer mcq / code
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
