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
        Schema::create('question_choices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id'); // 質問ID（外部キー）
            $table->unsignedBigInteger('question_number'); // 選択肢の番号（例：1, 2, 3など）
            $table->string('choice_text'); // 選択肢の文（例：甘い、辛いなど）
            $table->integer('score'); // スコア（診断用）
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_choices');
    }
};
