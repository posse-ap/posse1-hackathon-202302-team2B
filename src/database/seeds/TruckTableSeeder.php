<?php

use Illuminate\Database\Seeder;
use App\Models\Truck;

class TruckTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d H:i:s");
        for ($i = 1; $i <= 5; $i++) {
            Truck::insert([
                'id'         => $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
