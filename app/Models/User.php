<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'twitter_id',
        'oauth_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public static $roles = [
        'admin'      => 'Administrador',
    ];

    public static $rol_aliases = [
        'admin'     => 'Administrador',
    ];

    public static $roles_color = [
        'admin'      => '#B40404',
    ];

    public static $icon_roles = [
        'admin'      => 'fa-address-card',
    ];

    public function getRoleNameAttribute()
    {   
        return Self::$roles[$this->role];
    }

    public function getRoleColorAttribute()
    {   
        return Self::$roles_color[$this->role];
    }
}
