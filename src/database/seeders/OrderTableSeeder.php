<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\DeliveryAddress;
use App\Models\Truck;
use App\Models\DeliveryMethod;
use App\Models\DeliveryStatus;
use App\Models\Order;

class OrderTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$user_id = User::where('role_id', Role::getUserId())->first()->id;
		$delivery_addresses = DeliveryAddress::where('user_id', $user_id)->get();
		foreach ($delivery_addresses as $delivery_address) {
			Order::create([
				'user_id'             => $user_id,
				'delivery_address_id' => $delivery_address->id,
				'delivery_date'       => '2023-02-22',
				'is_am'               => true,
				'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
				'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
				'total_price'         => collect([11700, 11500, 12500, 13300, 1430])->random(),
			]);
			Order::create([
				'user_id'             => $user_id,
				'delivery_address_id' => $delivery_address->id,
				'delivery_date'       => '2023-02-23',
				'is_am'               => false,
				'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
				'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
				'total_price'         => collect([11700, 11500, 12500, 13300, 1430])->random(),
			]);
			Order::create([
				'user_id'             => $user_id,
				'delivery_address_id' => $delivery_address->id,
				'delivery_date'       => '2023-02-24',
				'is_am'               => false,
				'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
				'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
				'total_price'         => collect([11700, 11500, 12500, 13300, 1430])->random(),
			]);
			Order::create([
				'user_id'             => $user_id,
				'delivery_address_id' => $delivery_address->id,
				'delivery_date'       => '2023-02-25',
				'is_am'               => false,
				'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
				'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
				'total_price'         => collect([11700, 11500, 12500, 13300, 1430])->random(),
			]);
			Order::create([
				'user_id'             => $user_id,
				'delivery_address_id' => $delivery_address->id,
				'delivery_date'       => '2023-02-26',
				'is_am'               => false,
				'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
				'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
				'total_price'         => collect([11700, 11500, 12500, 13300, 1430])->random(),
			]);
			Order::create([
				'user_id'             => $user_id,
				'delivery_address_id' => $delivery_address->id,
				'delivery_date'       => '2023-02-27',
				'is_am'               => false,
				'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
				'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
				'total_price'         => collect([11700, 11500, 12500, 13300, 1430])->random(),
			]);
		}

		$user_id = 4;
		$delivery_addresses = DeliveryAddress::where('user_id', $user_id)->get();
		foreach ($delivery_addresses as $delivery_address) {
			Order::create([
				'user_id'             => $user_id,
				'delivery_address_id' => $delivery_address->id,
				'delivery_date'       => '2023-02-22',
				'is_am'               => true,
				'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
				'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
				'total_price'         => collect([11700, 11500, 12500, 13300, 1430])->random(),
			]);
			Order::create([
				'user_id'             => $user_id,
				'delivery_address_id' => $delivery_address->id,
				'delivery_date'       => '2023-02-23',
				'is_am'               => false,
				'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
				'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
				'total_price'         => collect([11700, 11500, 12500, 13300, 1430])->random(),
			]);
			Order::create([
				'user_id'             => $user_id,
				'delivery_address_id' => $delivery_address->id,
				'delivery_date'       => '2023-02-24',
				'is_am'               => false,
				'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
				'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
				'total_price'         => collect([11700, 11500, 12500, 13300, 1430])->random(),
			]);
			Order::create([
				'user_id'             => $user_id,
				'delivery_address_id' => $delivery_address->id,
				'delivery_date'       => '2023-02-25',
				'is_am'               => false,
				'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
				'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
				'total_price'         => collect([11700, 11500, 12500, 13300, 1430])->random(),
			]);
			Order::create([
				'user_id'             => $user_id,
				'delivery_address_id' => $delivery_address->id,
				'delivery_date'       => '2023-02-26',
				'is_am'               => false,
				'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
				'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
				'total_price'         => collect([11700, 11500, 12500, 13300, 1430])->random(),
			]);
			Order::create([
				'user_id'             => $user_id,
				'delivery_address_id' => $delivery_address->id,
				'delivery_date'       => '2023-02-27',
				'is_am'               => false,
				'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
				'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
				'total_price'         => collect([11700, 11500, 12500, 13300, 1430])->random(),
			]);
		}
	}
}
