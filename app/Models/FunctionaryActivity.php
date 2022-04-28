<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionaryActivity extends Model
{
    use HasFactory;

    protected $appends = [
        'name'
    ];

    public function period()
    {
        return $this->hasOne('App\Models\Period', 'id', 'period_id');
    }

    public function functionary()
    {
        return $this->hasOne('App\Models\Functionary', 'id', 'functionary_id');
    }

    public function law()
    {
        return $this->hasOne('App\Models\Law', 'id', 'law_id');
    }

    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }

    /* Attributes */
    public function getNameAttribute()
    {
        $res = '';
        if (isset($this->law)) {
            $res = $this->law->law_name;
        }

        if (isset($this->project)) {
            $res = $this->project->project_name;
        }

        return $res;
    }
}
