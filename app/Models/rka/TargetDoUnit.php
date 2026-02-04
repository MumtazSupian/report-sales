<?php

namespace App\Models\rka;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetDoUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobil_type',
        'tahun',
        'jan','feb','mar','apr','mei','jun',
        'jul','agu','sep','okt','nov','des',
        'total'
    ];
}
