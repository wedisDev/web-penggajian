<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatans')->insert([
            [
                'nama_jabatan' => 'Chef',
                'gapok' => '1000000',
                'tunjangan_makmur' => '450000',
                'tunjangan_makan' => '20000',
                'tunjangan_transportasi' => '10000',
                'tunjangan_lembur' => '25000',
                'bonus_tahunan' => '120000',	
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Pramusaji',
                'gapok' => '500000',
                'tunjangan_makmur' => '250000',
                'tunjangan_makan' => '15000',
                'tunjangan_transportasi' => '10000',
                'tunjangan_lembur' => '15000',
                'bonus_tahunan' => '50000',	
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Kasir',
                'gapok' => '750000',
                'tunjangan_makmur' => '380000',
                'tunjangan_makan' => '15000',
                'tunjangan_transportasi' => '10000',
                'tunjangan_lembur' => '15000',
                'bonus_tahunan' => '50000',	
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Outlet Manager',
                'gapok' => '1300000',
                'tunjangan_makmur' => '500000',
                'tunjangan_makan' => '20000',
                'tunjangan_transportasi' => '10000',
                'tunjangan_lembur' => '5000',
                'bonus_tahunan' => '150000',	
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Cook Helper',
                'gapok' => '400000',
                'tunjangan_makmur' => '150000',
                'tunjangan_makan' => '15000',
                'tunjangan_transportasi' => '5000',
                'tunjangan_lembur' => '15000',
                'bonus_tahunan' => '50000',	
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Expeditor',
                'gapok' => '650000',
                'tunjangan_makmur' => '400000',
                'tunjangan_makan' => '25000',
                'tunjangan_transportasi' => '30000',
                'tunjangan_lembur' => '15000',
                'bonus_tahunan' => '100000',	
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
