<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'nameCategory' => 'Limpieza personal',
        ]);
        Category::create([
            'nameCategory' => 'Productos alimenticios',
        ]);
        Category::create([
            'nameCategory' => 'Tecnología',
        ]);
    }
}
