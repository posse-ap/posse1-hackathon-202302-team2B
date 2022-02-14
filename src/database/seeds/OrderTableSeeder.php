<?php

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
        $truck_id = Truck::first()->id;
        foreach ($delivery_addresses as $delivery_address) {
            Order::create([
                'user_id'             => $user_id,
                'delivery_address_id' => $delivery_address->id,
                'delivery_date'       => '2019-12-24',
                'is_am'               => true,
                'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
                'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
                'total_price'         => collect([1000, 1500, 2000, 3000, 4000])->random(),
                'truck_id'            => $truck_id,
            ]);
            Order::create([
                'user_id'             => $user_id,
                'delivery_address_id' => $delivery_address->id,
                'delivery_date'       => '2019-12-25',
                'is_am'               => false,
                'delivery_method_id'  => DeliveryMethod::getPackageDropId(),
                'delivery_status_id'  => DeliveryStatus::getInPreparationId(),
                'total_price'         => collect([1000, 1500, 2000, 3000, 4000])->random(),
                'truck_id'            => $truck_id,
            ]);
        }
    }
}
