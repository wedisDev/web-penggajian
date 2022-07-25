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
            'nama_golongan' => 'Menikah',
            'tunjangan_menikah' => '100000',
            'tunjangan_anak' => '50000',
            'created_at' => now(),
            'updated_at' => now(),
           ],
           [
            'nama_golongan' => 'Cerai',
            'tunjangan_menikah' => '50000',
            'tunjangan_anak' => '50000',
            'created_at' => now(),
            'updated_at' => now(),
           ],
           [
            'nama_golongan' => 'Single',
            'tunjangan_menikah' => '0',
            'tunjangan_anak' => '50000',
            'created_at' => now(),
            'updated_at' => now(),
           ]
        ]);
    }
}
