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
                'score' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 1,
                'choice_text' => '甘い',
                'score' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
