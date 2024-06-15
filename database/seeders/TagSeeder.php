<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        DB::beginTransaction();

        try {
            $tags = [
                ['name' => 'GameSynth'],
                ['name' => 'DSP Motion'],
                ['name' => 'DSP Action'],
                // 他のタグも必要に応じて追加
            ];

            foreach ($tags as $tagData) {
                $tag = Tag::firstOrCreate($tagData);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Tag seeder failed: ' . $e->getMessage());
        }
    }
}
