<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "version"     => 1,
            "name"        => 'フレッシュで甘いトマト',
            "description" => 'フレッシュで甘いトマト！まさにフレッシュフレッシュフレッシュ',
            "thumbnail"   => '1_thumbnail.jpg',
            "image1"      => '1_image1.jpg',
            "quantity"    => '1箱10個入り',
            "price"       => 900,
            "is_active"   => true,
        ]);
        Product::create([
            "version"     => 1,
            "name"        => 'とてもフレッシュ',
            "description" => 'とてもフレッシュ！まさにフレッシュフレッシュフレッシュ',
            "thumbnail"   => '2_thumbnail.jpg',
            "image1"      => '2_image1.jpg',
            "quantity"    => '1箱20個入り',
            "price"       => 100,
            "is_active"   => true,
        ]);
        Product::create([
            "version"     => 1,
            "name"        => 'フレッシュ極まれリ',
            "description" => 'フレッシュ極まれリ！まさにフレッシュフレッシュフレッシュ',
            "thumbnail"   => '3_thumbnail.jpg',
            "image1"      => '3_image1.jpg',
            "quantity"    => '1箱30個入り',
            "price"       => 200,
            "is_active"   => false,
        ]);
    }
}
