<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

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
			"name"         => '管理太郎',
			"email"        => 'admin1@gmail.com',
			"password"     => Hash::make('password'),
			"company_name" => 'テスト1株式会社',
			"role_id"      => Role::getAdminId(),
		]);
		User::create([
			"name"         => '管理之介',
			"email"        => 'admin2@gmail.com',
			"password"     => Hash::make('password'),
			"company_name" => 'テスト2株式会社',
			"role_id"      => Role::getAdminId(),
		]);
		User::create([
			"name"         => '一般角栄',
			"email"        => 'user1@gmail.com',
			"password"     => Hash::make('password'),
			"company_name" => 'テスト3株式会社',
			"role_id"      => Role::getUserId(),
		]);
		User::create([
			"name"         => '一般有朋',
			"email"        => 'user2@gmail.com',
			"password"     => Hash::make('password'),
			"company_name" => 'テスト4株式会社',
			"role_id"      => Role::getUserId(),
		]);
		User::create([
			"name"         => '配送・D・太郎',
			"email"        => 'delivery_agent1@gmail.com',
			"password"     => Hash::make('password'),
			"company_name" => 'テスト5株式会社',
			"role_id"      => Role::getDeliveryAgentId(),
		]);
		User::create([
			"name"         => '配送・デリバー・小次郎',
			"email"        => 'delivery_agent2@gmail.com',
			"password"     => Hash::make('password'),
			"company_name" => 'テスト6株式会社',
			"role_id"      => Role::getDeliveryAgentId(),
		]);
	}
}
