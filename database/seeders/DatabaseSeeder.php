<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 他のシーダークラスがある場合はそれらも呼び出せます。
        $this->call(TagSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
