<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'round','match','league_id', 'time',
        'stadium','date','set_1_team_1','set_1_team_2','set_2_team_1',
        'set_2_team_2','set_3_team_2','set_3_team_1','result_team_2','result_team_1',
        'player1_team_1','player2_team_1','player1_team_2','player2_team_2',
    ];

    public function league()
    {
        return $this->belongsTo('App\Models\League', 'league_id', 'id');
    }

    public function player1Team1()
    {
        return $this->belongsTo('App\Models\User', 'player1_team_1', 'id');
    }

    public function player2Team1()
    {
        return $this->belongsTo('App\Models\User', 'player2_team_1', 'id');
    }

    public function player1Team2()
    {
        return $this->belongsTo('App\Models\User', 'player1_team_2', 'id');
    }

    public function player2Team2()
    {
        return $this->belongsTo('App\Models\User', 'player2_team_2', 'id');
    }
}
