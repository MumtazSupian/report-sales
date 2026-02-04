<?php

namespace App\Models\rka;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_inquiry',
        'tahun',
        'jan','feb','mar','apr','mei','jun',
        'jul','agu','sep','okt','nov','des',
        'total'
    ];
}
