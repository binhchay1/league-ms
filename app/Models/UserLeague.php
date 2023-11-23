<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLeague extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'league_id','user_id'
    ];

    public function league()
    {
        return $this->belongsTo('App\Models\League');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
}
