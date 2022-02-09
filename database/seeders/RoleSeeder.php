<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Admin','display_name'=>'Quản trị hệ thống'],
            ['name' => 'User','display_name'=>'Người dùng'],
            ['name' => 'Developer','display_name'=>'Người phát triển'],
            ['name' => 'Editor','display_name'=>'Người cập nhật bài viết'],
        ]);
    }
}
