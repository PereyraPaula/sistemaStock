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
        // \App\Models\User::factory(10)->create();
        \App\Models\Article::factory(20)->create();
        $this->call(CategorySeeder::class);
        $this->call(HeadproofSeeder::class);
        $this->call(LineproofSeeder::class);
    }
}
