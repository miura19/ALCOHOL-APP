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
        Schema::create('alcohol_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genre_id'); // ← ジャンルID
            $table->string('name'); // 酒の名前
            $table->string('image')->nullable(); // 画像パス
            $table->text('description')->nullable(); // 酒の説明
            $table->integer('min_score'); // 推奨スコア範囲（下限）
            $table->integer('max_score'); // 推奨スコア範囲（上限）
            $table->timestamps();

            // 外部キー制約（alcohol_genre_masters.id を参照）
            $table->foreign('genre_id')->references('id')->on('alcohol_genre_masters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alcohol_masters');
    }
};
