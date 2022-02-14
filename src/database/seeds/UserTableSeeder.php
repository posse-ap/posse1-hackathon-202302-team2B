<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"         => '管理者',
            "email"        => 'admin@gmail.com',
            "password"     => '$2y$10$F/j.V6StHHd7zPyUC6i23u66P6C8dJZOGrVAVM9CHMA9zBottLTXa',
            "company_name" => 'テスト株式会社',
            "role_id"      => Role::getAdminId(),
        ]);
        User::create([
            "name"         => '一般ユーザー',
            "email"        => 'user@gmail.com',
            "password"     => '$2y$10$F/j.V6StHHd7zPyUC6i23u66P6C8dJZOGrVAVM9CHMA9zBottLTXa',
            "company_name" => 'テスト株式会社',
            "role_id"      => Role::getUserId(),
        ]);
        User::create([
            "name"         => '配送業者',
            "email"        => 'delivery_agent@gmail.com',
            "password"     => '$2y$10$F/j.V6StHHd7zPyUC6i23u66P6C8dJZOGrVAVM9CHMA9zBottLTXa',
            "company_name" => 'テスト株式会社',
            "role_id"      => Role::getDeliveryAgentId(),
        ]);
    }
}
