<?php

namespace App\Models\current;

use Illuminate\Database\Eloquent\Model;

class ActualSourceInquary extends Model
{
    protected $table = 'actual_source_inquary';

    protected $fillable = [
        'source_inquary',
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
