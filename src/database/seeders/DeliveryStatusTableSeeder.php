<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryStatus;

class DeliveryStatusTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$now = date("Y-m-d H:i:s");
		foreach (['準備中', '配送中', '配送済', 'キャンセル中', 'キャンセル済', '返品申請中', '返品配送待ち', '返品配送中', '返品済み'] as $index => $name) {
			DeliveryStatus::insert([
				'id'         => $index + 1,
				"name"       => $name,
				'created_at' => $now,
				'updated_at' => $now,
			]);
		}
	}
}
