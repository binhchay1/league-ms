<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Message;
use App\Models\VerifyUser;
use App\Models\Ranking;
use App\Models\GroupUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'title'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_path',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id', 'id');
    }

    public function verifyUser()
    {
        return $this->hasOne(VerifyUser::class);
    }

    public function ranking()
    {
        return $this->hasMany(Ranking::class);
    }

    public function group()
    {
        return $this->hasMany(GroupUser::class, 'user_id', 'id');
    }

    public function userLeagues()
    {
        return $this->hasMany('App\Models\UserLeague');
    }
}
