<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'images', 'start_date', 'end_date', 'format_of_league', 'number_of_athletes', 'type_of_league', 'slug', 'location', 'money','end_date_register'
    ];

    public function schedule()
    {
        return $this->hasMany(Schedule::class)->orderBy('date')->orderBy('time');
    }

    public function userLeagues()
    {
        return $this->hasMany('App\Models\UserLeague');
    }
}
