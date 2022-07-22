<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('golongans')->insert([
           [
            'tunjangan_menikah' => '100000',
            'tunjangan_anak' => '50000',
            'created_at' => now(),
            'updated_at' => now(),
           ],
           [
            'tunjangan_menikah' => '50000',
            'tunjangan_anak' => '50000',
            'created_at' => now(),
            'updated_at' => now(),
           ],
           [
            'tunjangan_menikah' => '0',
            'tunjangan_anak' => '50000',
            'created_at' => now(),
            'updated_at' => now(),
           ]
        ]);
    }
}
