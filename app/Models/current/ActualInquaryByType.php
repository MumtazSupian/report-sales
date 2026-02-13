<?php

namespace App\Models\current;

use Illuminate\Database\Eloquent\Model;

class ActualInquaryByType extends Model
{
    protected $table = 'actual_inquary_by_type';

    protected $fillable = [
        'jenis_unit',
        'type_unit',
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
        'total',
        'cabang'
    ];
}
