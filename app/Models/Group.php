<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GroupUser;
use App\Models\User;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'images',
        'description',
        'number_of_members',
        'location',
        'note',
        'rate',
        'status',
        'active',
        'group_owner'
    ];

    public function group_users()
    {
        return $this->hasMany(GroupUser::class);
    }

    public function group_trainings()
    {
        return $this->hasMany(GroupTraining::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'group_owner', 'id');
    }
}
