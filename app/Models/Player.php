<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'team_id','birthday', 'image', 'sex'
    ];

    public function teams()
    {
        return $this->belongsTo('App\Models\Team', 'team_id');
    }
}
