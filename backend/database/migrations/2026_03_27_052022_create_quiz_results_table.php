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
// quiz_results (id, user_id, quiz_id, score, started_at, submitted_at, is_passed)

        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quiz_id');
            $table->bigInteger('user_id');
            $table->decimal('score', 8, 2)->default(0);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->boolean('is_passed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_results');
    }
};
