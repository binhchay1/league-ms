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
        'activity_time',
        'number_of_members',
        'location',
        'note',
        'rate',
        'active',
        'group_id'
    ];

    public function groups()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
