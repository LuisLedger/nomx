<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawThemes extends Model
{
    use HasFactory;

    public function law()
    {
        return $this->hasOne('App\Models\Law', 'id', 'law_id');
    }

    public function theme_social()
    {
        return $this->hasOne('App\Models\ThemeSocial', 'id', 'theme_social_id');
    }
}
