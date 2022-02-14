<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d H:i:s");
        foreach (['admin', 'user', 'delivery-agent'] as $index => $name) {
            Role::insert([
                'id'         => $index + 1,
                'name'       => $name,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
