<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Omzet extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('omzet')->insert([
            [
                'id_cabang' => 1,
                'omzet' => 120000000,
                'date' =>  Carbon::now()
            ],
            [
                'id_cabang' => 2,
                'omzet' => 200000000,
                'date' =>  Carbon::now()
            ],
            [
                'id_cabang' => 3,
                'omzet' => 190000000,
                'date' =>  Carbon::now()
            ],
            [
                'id_cabang' => 4,
                'omzet' => 300000000,
                'date' =>  Carbon::now()
            ],
        ]);
    }
}
