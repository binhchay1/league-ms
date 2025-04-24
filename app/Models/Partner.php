<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'avatar',
        'phone',
        'email',
        'created_by_user_id',

    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'created_by_user_id', 'id');
    }
}
