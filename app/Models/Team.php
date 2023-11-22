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

    public function schedule()
    {
        return $this->hasMany('App\Models\Schedule');
    }
}
