<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;

class GroupUser extends Model
{
    use HasFactory;

    protected $table = 'group_users';

    protected $fillable = [
        'group_id', 'user_id', 'status_request'
    ];

    public function groups()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
