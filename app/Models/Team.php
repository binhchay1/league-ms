<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','coach', 'image'
    ];

    public function players()
    {
        return $this->hasMany('App\Models\Player');
    }
}
