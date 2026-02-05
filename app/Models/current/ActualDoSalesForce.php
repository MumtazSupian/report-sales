<?php

namespace App\Models\current;

use Illuminate\Database\Eloquent\Model;

class ActualDoSalesForce extends Model
{
    protected $table = 'actual_do_salesforces';

    protected $fillable = [
        'grading',
        'tahun',
        'jan','feb','mar','apr','mei','jun','jul','agu','sep','okt','nov','des',
        'total'
    ];
}
