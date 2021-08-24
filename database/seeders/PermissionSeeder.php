<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'manage_project',
            'persian_name' => 'ساخت و تغییر پروژه'
        ]);
        DB::table('permissions')->insert([
            'name' => 'manage_lists',
            'persian_name' => 'ساخت و تغییر لیست'
        ]);
        DB::table('permissions')->insert([
            'name' => 'manage_tags',
            'persian_name' => 'ساخت و تغییر برچسب ها'
        ]);
        DB::table('permissions')->insert([
            'name' => 'manage_task',
            'persian_name' => 'ساخت و تغییر وظیفه'
        ]);

    }
}
