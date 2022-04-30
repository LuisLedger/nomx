<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectThemes extends Model
{
    use HasFactory;

    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }

    public function theme_social()
    {
        return $this->hasOne('App\Models\ThemeSocial', 'id', 'theme_social_id');
    }
}
