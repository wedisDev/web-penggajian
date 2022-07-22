<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jabatan',
        'id_cabang',
        'nama_pegawai',
        'jenis_kelamin',
        'alamat',
        'status',
        'tahun_masuk',
        'jumlah_anak'
    ];

    public function jabatan(){

        return $this->belongsTo(Jabatan::class);
    }

    public function cabang(){

        return $this->belongsTo(Cabang::class);
    }
}
