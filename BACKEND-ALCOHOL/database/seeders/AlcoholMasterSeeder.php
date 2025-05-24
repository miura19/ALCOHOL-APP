<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlcoholMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alcohol_masters')->insert([
            [
                'name' => 'サッポロ黒ラベル',
                'genre_id' => 1,
                'min_score' => 0,
                'max_score' => 5,
                'description' => '飲みごたえがあり、スッキリとした味わい',
                'image' => 'http://localhost/images/sapporo_beer.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'アサヒスーパードライ',
                'genre_id' => 1,
                'min_score' => 6,
                'max_score' => 10,
                'description' => 'キレのある爽快なビール',
                'image' => 'http://localhost/images/asahi_beer.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'キリン一番搾り',
                'genre_id' => 1,
                'min_score' => 11,
                'max_score' => 15,
                'description' => '麦のうまみがしっかり感じられる味わい',
                'image' => 'http://localhost/images/kirin_beer.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'プレミアムモルツ',
                'genre_id' => 1,
                'min_score' => 16,
                'max_score' => 20,
                'description' => '香り豊かでまろやかなコク',
                'image' => 'http://localhost/images/premium_malts_beer.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'よなよなエール',
                'genre_id' => 1,
                'min_score' => 21,
                'max_score' => 25,
                'description' => 'フルーティーで香り高いクラフトビール',
                'image' => 'http://localhost/images/yonayona_beer.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
