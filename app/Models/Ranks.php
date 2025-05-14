<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ranks extends Model
{
    use HasFactory;

    protected $table = 'ranks';

    protected $fillable = [
        'league_id',
        'team_id',
        'match_played',
        'win',
        'lose',
        'point',
        'eliminated_round',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'team_id', 'id');
    }

    public function league()
    {
        return $this->belongsTo(League::class, 'league_id', 'id');
    }
}
