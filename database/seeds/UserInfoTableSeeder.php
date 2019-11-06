<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('user_info')->insert([
          'fullname' => 'Phan Trọng Tuyển',
          'address' => 'Thái Bình',
          'user_id' => 13,
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now()
       ]);
    }
}
