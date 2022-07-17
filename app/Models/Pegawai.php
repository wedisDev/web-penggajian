<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pegawai',
        'id_jabatan',
        'id_golongan',
        'status',
        'jumlah_anak'
    ];

    public function jabatan(){

        return $this->belongsTo(Jabatan::class);
    }

    public function golongan(){

        return $this->belongsTo(Golongan::class);
    }
}
