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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chapter_id');
            $table->string('title');
            $table->text('content');
            $table->integer('order')->default(0);
            $table->string('video_url')->nullable();
            $table->integer('score_requirement')->default(0); // Điểm yêu cầu để mở khóa bài học
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
