<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           [
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
           ],
           [
            'name' => 'pegawai',
            'role' => 'pegawai',
            'email' => 'pegawai@gmail.com',
            'password' => bcrypt('pegawai123')
           ],
           [
            'name' => 'owner',
            'role' => 'owner',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('owner123')
           ]
        ]);
    }
}
