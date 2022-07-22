<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusOmzet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cabang',
        'id_jabatan',
        'bonus',
    ];
}
