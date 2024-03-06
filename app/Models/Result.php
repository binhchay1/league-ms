<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'results';

    protected $fillable = [
        'schedule_id', 'result_round_1', 'result_round_2', 'result_round_3'
    ];
}
