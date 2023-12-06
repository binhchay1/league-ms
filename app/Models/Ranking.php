<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ranking extends Model
{
    use HasFactory;

    protected $table = 'ranking';

    protected $fillable = [
        'user_id', 'points', 'type', 'places'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
