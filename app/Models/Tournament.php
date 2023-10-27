<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image','start_date', 'end_date', 'format', 'number_of_team', 'type'
    ];


    public function schedule()
    {
        return $this->hasMany('App\Models\Schedule');
    }
}
