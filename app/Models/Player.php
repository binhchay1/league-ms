<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class Player extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'player';
    protected $fillable = [
        'name',
        'number_shirt',
        'avatar',
        'playing_position',
    ];


}
