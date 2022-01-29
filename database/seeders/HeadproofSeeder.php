<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
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
            $start = strtotime("1973-jan-01");
            $final = strtotime("2021-dec-31");
            $date_format = date("y-m-d", mt_rand($start, $final));

            if ($i%2==0) {
                $type = 'Compra';
            }else{
                $type = 'Venta';
            }

            if ((bool)random_int(0,1) === 0) {
              $bool = true;
            }else{
              $bool = false;
            }
            Headproof::create([
                'type_movement' => $type,
                'date_movement' => $date_format,
                'open' => $bool,
            ]);
        }
    }
}
