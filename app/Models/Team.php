<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'player_id','coach', 'image'
    ];

    public function player()
    {
        return $this->hasMany('App\Models\Player', 'player_id');
    }
}