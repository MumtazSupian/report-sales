<?php

namespace App\Models\evaluasi;

use Illuminate\Database\Eloquent\Model;

class EvaluasiWiraniaga extends Model
{
    protected $table = 'evaluasi_wiraniaga';

    protected $fillable = [
        'nama_sales_head',
        'nama_sales',
        'tanggal_masuk',
        'tanggal_evaluasi',
        'grading',
        'jan',
        'feb',
        'mar',
        'apr',
        'mei',
        'jun',
        'total',
        'evaluasi',
        'tanggal_keluar'
    ];
}
