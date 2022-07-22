<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cabangs')->insert([
            [
                'nama_cabang' => 'Kantin Tante Royal',
                'alamat' => 'Jl. Raya Tante Royal No.1',
            ],
            [
                'nama_cabang' => 'Kantin Tante DTC',
                'alamat' => 'Jl. Raya Tante DTC No.1',
            ],
            [
                'nama_cabang' => 'Kantin Tante Pasar Atom',
                'alamat' => 'Jl. Raya Tante Pasar Atom No.1',
            ],
            [
                'nama_cabang' => 'Pujasera Tante Embong wungu',
                'alamat' => 'Jl. Raya Tante Embong Wungu No.1',
            ],
        ]);
    }
}
