<?php

namespace App\Models\current;

use Illuminate\Database\Eloquent\Model;

class ActualSalesByLeasing extends Model
{
    protected $table = 'actual_sales_by_leasing';

    protected $fillable = [
        'leasing_name',
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
