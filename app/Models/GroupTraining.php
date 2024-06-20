<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTraining extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'number_of_members',
        'location',
        'note',
        'rate',
        'active',
        'group_id',
        'owner_user',
        'end_time',
        'start_time',
        'date'
    ];

    public function groups()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'owner_user', 'id');
    }
}
