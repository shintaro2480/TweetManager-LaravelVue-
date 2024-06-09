<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        Tag::create(['name' => 'GameSynth']);
        Tag::create(['name' => 'DSP Motion']);
        Tag::create(['name' => 'DSP Action']);
        // 他のタグも必要に応じて追加
    }
}





