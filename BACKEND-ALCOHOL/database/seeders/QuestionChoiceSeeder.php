<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('question_choices')->insert([
            [
                'question_id' => 1,
                'choice_text' => '苦い',
                'question_number' => 1,
                'score' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 1,
                'choice_text' => '甘い',
                'question_number' => 2,
                'score' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 2,
                'choice_text' => 'サッポロ',
                'question_number' => 1,
                'score' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 2,
                'choice_text' => 'アサヒ',
                'question_number' => 2,
                'score' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 2,
                'choice_text' => 'キリン',
                'question_number' => 3,
                'score' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 2,
                'choice_text' => 'その他',
                'question_number' => 4,
                'score' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 3,
                'choice_text' => '好き',
                'question_number' => 1,
                'score' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 3,
                'choice_text' => 'そうでもない',
                'question_number' => 2,
                'score' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
