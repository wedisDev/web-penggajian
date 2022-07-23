<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bonus_omzets')->insert([
            [
                'id_cabang' => 1,
                'id_jabatan' => 1,
                'bonus' => 225000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_cabang' => 2,
                'id_jabatan' => 1,
                'bonus' => 75000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_cabang' => 3,
                'id_jabatan' => 1,
                'bonus' => 95000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_cabang' => 4,
                'id_jabatan' => 1,
                'bonus' => 50000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
