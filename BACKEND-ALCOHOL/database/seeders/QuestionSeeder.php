<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('questions')->insert([
            [
                'genre_id' => 1, // ビール
                'question_text' => 'どんな味が好き？',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 他の質問も追加OK
        ]);
    }
}
