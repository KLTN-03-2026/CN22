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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_free');
            $table->decimal('price', 15, 2)->default(0);
            $table->integer('status')->default(1); // '0': Inactive, '1': Active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
