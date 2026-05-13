<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // 管理者
    DB::table('users')->insert([
      'last_name_kana' => 'カンリシャ',
      'first_name_kana' => 'タロウ',
      'last_name' => '管理者',
      'first_name' => '太郎',
      'email' => 'admin000@sample.com',
      'password_hash' => Hash::make('admin000'),
      'status'          => 2,
      'role' => 0,
    ]);

    // 一般ユーザー
    DB::table('users')->insert([
        'last_name_kana'  => 'カシハラ',
        'first_name_kana' => 'ユカ',
        'last_name'       => '樫原',
        'first_name'      => '優花',
        'email'           => 'user001@sample.com',
        'password_hash'   => Hash::make('user0001'),
        'status'          => 2,
        'role'            => 1,
    ]);
  }
}
