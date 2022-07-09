<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_jabatan',
        'id_golongan',
        'status',
        'jumlah_anak'
    ];
}
