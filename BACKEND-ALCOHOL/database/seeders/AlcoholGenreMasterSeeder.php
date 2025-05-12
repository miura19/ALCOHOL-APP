<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlcoholGenreMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alcohol_genre_masters')->insert([
            'name'       => 'ビール',
            'image'      => 'http://localhost/images/drink_beer.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('alcohol_genre_masters')->insert([
            'name'       => 'チューハイ',
            'image'      => 'http://localhost/images/soda1_lemon.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('alcohol_genre_masters')->insert([
            'name'       => 'ウイスキー',
            'image'      => 'http://localhost/images/drink_whisky.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('alcohol_genre_masters')->insert([
            'name'       => 'ワイン',
            'image'      => 'http://localhost/images/wine_bottle_bourgogne.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
