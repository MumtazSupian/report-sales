<?php

namespace App\Models\leasing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktualReject extends Model
{
    use HasFactory;

    protected $table = 'aktual_reject';

    protected $fillable = [
        'leasing',
        'tahun',
        'jan','feb','mar','apr','mei','jun',
        'jul','agu','sep','okt','nov','des',
        'total',
    ];
}
