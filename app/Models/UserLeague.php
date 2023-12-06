<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\League;
use App\Models\User;

class UserLeague extends Model
{
    use HasFactory;

    protected $fillable = [
        'league_id','user_id','status',
    ];

    public function league()
    {
        return $this->belongsTo(League::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
