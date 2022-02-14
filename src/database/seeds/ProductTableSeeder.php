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
        Product::create([
            "version"     => 1,
            "name"        => 'シャキシャキキャベツ',
            "description" => 'シャキシャキ極まれリ！まさにシャキシャキシャキシャキシャキシャキ',
            "thumbnail"   => '4_thumbnail.jpg',
            "image1"      => '4_image1.jpg',
            "quantity"    => '1箱5玉入り',
            "price"       => 200,
            "is_active"   => true,
        ]);
        Product::create([
            "version"     => 1,
            "name"        => 'とてもシャキシャキ',
            "description" => 'とてもシャキシャキ！まさにシャキシャキシャキシャキシャキシャキ',
            "thumbnail"   => '5_thumbnail.jpg',
            "image1"      => '5_image1.jpg',
            "quantity"    => '1箱5玉入り',
            "price"       => 400,
            "is_active"   => true,
        ]);
        Product::create([
            "version"     => 1,
            "name"        => '甘い春キャベツ',
            "description" => 'とても甘い！',
            "thumbnail"   => '6_thumbnail.jpg',
            "image1"      => '6_image1.jpg',
            "quantity"    => '1箱5玉入り',
            "price"       => 800,
            "is_active"   => false,
        ]);
        Product::create([
            "version"     => 1,
            "name"        => '柔らかいにんじん',
            "description" => 'とても柔らかい！',
            "thumbnail"   => '7_thumbnail.jpg',
            "image1"      => '7_image1.jpg',
            "quantity"    => '1箱8本入り',
            "price"       => 700,
            "is_active"   => true,
        ]);
        Product::create([
            "version"     => 1,
            "name"        => '甘いにんじん',
            "description" => 'とても甘いにんじん！',
            "thumbnail"   => '8_thumbnail.jpg',
            "image1"      => '8_image1.jpg',
            "quantity"    => '1箱4本入り',
            "price"       => 400,
            "is_active"   => true,
        ]);
        Product::create([
            "version"     => 1,
            "name"        => '旬のにんじん',
            "description" => 'とても旬！まさに旬！',
            "thumbnail"   => '9_thumbnail.jpg',
            "image1"      => '9_image1.jpg',
            "quantity"    => '1箱3本入り',
            "price"       => 200,
            "is_active"   => false,
        ]);
    }
}
