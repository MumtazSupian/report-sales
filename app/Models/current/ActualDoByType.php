<?php

namespace App\Models\current;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActualDoByType extends Model
{
    protected $table = 'actual_do_by_type';

    protected $fillable = [
        'mobil_type',
        'tahun',
        'jan',
        'feb',
        'mar',
        'apr',
        'mei',
        'jun',
        'jul',
        'agu',
        'sep',
        'okt',
        'nov',
        'des',
        'total'
    ];
}
