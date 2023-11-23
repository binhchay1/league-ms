<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'images','start_date', 'end_date', 'format_of_league', 'number_of_team', 'type_of_league','slug', 'location', 'money'
    ];

    public function schedule()
    {
        return $this->hasMany('App\Models\Schedule');
    }
}
