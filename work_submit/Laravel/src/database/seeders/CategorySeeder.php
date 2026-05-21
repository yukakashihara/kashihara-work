<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name'       => '生果',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'ジュース',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'グッズ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
