<?php

namespace App\Models\rka;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetDoUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_unit',
        'type_unit',
        'tahun',
        'jan','feb','mar','apr','mei','jun',
        'jul','agu','sep','okt','nov','des',
        'total',
        'cabang'
    ];
}
