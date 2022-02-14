<?php

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
        // マスターテーブルの作成
        $this->call([
            RoleTableSeeder::class,
            DeliveryMethodTableSeeder::class,
            DeliveryStatusTableSeeder::class,
        ]);

        $this->call([
            TruckTableSeeder::class,
            UserTableSeeder::class,
            DeliveryAddressTableSeeder::class,
            ProductTableSeeder::class,
            OrderTableSeeder::class,
            OrderDetailTableSeeder::class,
        ]);
    }
}
