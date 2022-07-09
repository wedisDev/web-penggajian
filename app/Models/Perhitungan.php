<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perhitungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pegawai',
        'lembur',
        'pelanggaran',
        'bulan',
        'omzet',
        'bonus_omzet',
        'total'
    ];
}
