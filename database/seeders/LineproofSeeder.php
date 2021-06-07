<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lineproof;

class LineproofSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            Lineproof::create([
                'article_id' => rand(1,20),
                'quantity_movement' => rand(10,500),
                'amount_movement' => rand(1000,10000),
                'headproof_id' => rand(1,10),
            ]);
        }
    }
}
