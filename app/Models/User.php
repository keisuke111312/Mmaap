<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'username',
        'avatar_url',
        'portfolio_url',
        'contact',
        'email',
        'password',

        'access_level_id',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }

    public function skill()
    {
        return $this->hasMany(Skill::class);
    }
    public function resources()
    {
        return $this->hasMany(Resources::class);
    }

    public function accessLevel()
    {
        return $this->belongsTo(AccessLevel::class);
    }

    public function manualPayments()
    {
        return $this->hasMany(ManualPayment::class);
    }

        public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
