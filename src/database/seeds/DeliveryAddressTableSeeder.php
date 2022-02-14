<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\DeliveryAddress;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = User::where('role_id', Role::getUserId())->first()->id;

        DeliveryAddress::create([
            'user_id'     => $user_id,
            'name'        => '職場',
            'sort_number' => 1,
            'postal_code' => '000-0000',
            'prefecture'  => '東京都',
            'city'        => '港区',
            'address_1'   => '南青山３丁目１５−９',
            'address_2'   => 'MINOWA表参道3階',
            'tel'         => '090-XXXX-XXXX',
        ]);
        DeliveryAddress::create([
            'user_id'     => $user_id,
            'name'        => 'アパート',
            'sort_number' => 2,
            'postal_code' => '000-0000',
            'prefecture'  => '東京都',
            'city'        => '渋谷区',
            'address_1'   => '渋谷1-1-1',
            'address_2'   => 'ミスター渋谷 101号室',
            'tel'         => '090-XXXX-XXXX',
        ]);
        DeliveryAddress::create([
            'user_id'     => $user_id,
            'name'        => '実家',
            'sort_number' => 3,
            'postal_code' => '000-0000',
            'prefecture'  => '東京都',
            'city'        => '世田谷区',
            'address_1'   => '代田1-1-1',
            'address_2'   => '大胆な家 1001号室',
            'tel'         => '090-XXXX-XXXX',
        ]);
    }
}
