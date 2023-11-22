<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function group_users()
    {
        return $this->hasMany('App\Models\GroupUser');
    }

    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'group_owner');
    }
}
