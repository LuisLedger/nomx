<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

    protected $appends = [
        'theme',
        'theme_color',
    ];


    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function theme_social()
    {
        return $this->hasOne('App\Models\ThemeSocial', 'id', 'principal_theme_social_id');
    }

    public function state()
    {
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }    

    public function delegation()
    {
        return $this->hasOne('App\Models\Delegation', 'id', 'delegation_id');
    }    

    public function location()
    {
        return $this->hasOne('App\Models\Delegation', 'id', 'location_id');
    }    


    public function getThemeAttribute()
    {
        $res = '';
        if ($this->theme_social) {
            $res = $this->theme_social->name;
        }

        return $res;
    }

    public function getThemeColorAttribute()
    {
        $res = '';
        if ($this->theme_social) {
            $res = $this->theme_social->color;
        }

        return $res;
    }
}
