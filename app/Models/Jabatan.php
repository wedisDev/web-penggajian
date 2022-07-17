<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jabatan',
        'gapok',
        'tunjangan_makmur',
        'tunjangan_makan',
        'tunjangan_transportasi',
        'tunjangan_lembur'
    ];

}
