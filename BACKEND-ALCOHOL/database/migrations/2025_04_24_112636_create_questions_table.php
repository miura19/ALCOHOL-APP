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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genre_id'); // 外部キー（ジャンル）
            $table->string('question_text'); // 質問内容
            $table->unsignedInteger('order')->default(1); // 表示順（1〜5）
            $table->timestamps();
    
            $table->foreign('genre_id')->references('id')->on('alcohol_genre_masters')->onDelete('cascade');
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
