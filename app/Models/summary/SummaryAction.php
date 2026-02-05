<?php

namespace App\Models\summary;

use Illuminate\Database\Eloquent\Model;

class SummaryAction extends Model
{
     protected $fillable = [
        'operasional',
        'kondisi_yang_ada',
        'action_perbaikan',
        'do_dont'
    ];
}
