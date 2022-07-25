<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_golongan',
        'tunjangan_menikah',
        'tunjangan_anak'
    ];
}
