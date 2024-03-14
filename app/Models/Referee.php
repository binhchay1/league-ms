<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    use HasFactory;

    protected $table = 'referees';

    protected $fillable = [
        'user_id', 'schedule_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
