<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'match','tournament_id', 'team_id_1','team_id_2','time','date','stadium'
    ];

    public function tournament()
    {
        return $this->belongsTo('App\Models\Tournament', 'tournament_id', 'id');
    }

    public function team1()
    {
        return $this->belongsTo('App\Models\Team', 'team_id_1', 'id');
    }

    public function team2()
    {
        return $this->belongsTo('App\Models\Team', 'team_id_2', 'id');
    }

}
