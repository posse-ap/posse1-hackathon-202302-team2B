<?php

use Illuminate\Database\Seeder;
use App\Models\DeliveryMethod;

class DeliveryMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d H:i:s");
        foreach (['置き配', '受け取り'] as $index => $name) {
            DeliveryMethod::insert([
                'id'         => $index + 1,
                "name"       => $name,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
