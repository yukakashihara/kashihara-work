<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name'          => '温州みかん（5kg）',
                'description'   => 'もはや米、定番のみかん',
                'category_id'      => '1',
                'price'         => 2980,
                'stock_quantity' => 100,
                'image_path'    => '',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => '河内晩柑（5kg）',
                'description'   => '夏の救世主',
                'category_id'      => '1',
                'price'         => 2480,
                'stock_quantity' => 3,
                'image_path'    => '',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'ブラッドオレンジ（3kg）',
                'description'   => '希少な国産モロのストレートジュース',
                'category_id'      => '2',
                'price'         => 3480,
                'stock_quantity' => 0,
                'image_path'    => '',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
