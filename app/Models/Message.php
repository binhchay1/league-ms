<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;
use App\Models\User;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'group_id', 'user_id', 'message'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function groups()
    {
        return $this->belongsTo(Group::class, 'id', 'group_id');
    }
}
