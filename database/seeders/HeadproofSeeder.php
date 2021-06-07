<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Headproof;

class HeadproofSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            $start = strtotime("2021-may-23");
            $final = strtotime("2060-dec-31");
            $date_format = date("y-m-d", mt_rand($start, $final));
            
            if ($i%2==0) {
                $type = 'Compra';
            }else{
                $type = 'Venta';
            }
            Headproof::create([
                'type_movement' => $type,
                'date_movement' => $date_format,
            ]);
        }
    }
}
