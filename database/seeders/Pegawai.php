<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Pegawai extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')->insert([
            [
                'nama_pegawai' => 'Rendy',
                'id_jabatan' => 1,
                'id_cabang' => 1,
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Surabaya',
                'status' => 'menikah',
                'tahun_masuk' => Carbon::now(),
                'jumlah_anak' => 3,
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
