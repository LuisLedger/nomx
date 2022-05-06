<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public static $statuses = [
        0 => 'Deshechado',
        1 => 'Aprobado',
        2 => 'Discusión',
        3 => 'Votandose',
    ];

    public static $statuses_color = [
        0 => 'gray',
        1 => 'green',
        2 => 'blue',
        3 => 'orange',
    ];

    public static $statuses_icon = [
        0 => 'fa fa-ban',
        1 => 'fa fa-check',
        2 => 'fa fa-comments',
        3 => 'fa fa-hand-pointer',
    ];

    protected $appends = [
        'status_name',
        'status_color',
        'status_icon',
        'functionary_name',
        'politic_group_name',
        'theme_name',
    ];

    public function period()
    {
        return $this->hasOne('App\Models\Period', 'id', 'period_id');
    }

    public function functionary()
    {
        return $this->hasOne('App\Models\Functionary', 'id', 'promote_functionary_id');
    }

    public function politic_group()
    {
        return $this->hasOne('App\Models\PoliticGroup', 'id', 'politic_group_id');
    }

    public function level()
    {
        return $this->hasOne('App\Models\level', 'id', 'level_id');
    }

    public function period_start()
    {
        return $this->hasOne('App\Models\Period', 'id', 'start_period_id');
    }

    public function period_execution()
    {
        return $this->hasOne('App\Models\Period', 'id', 'execution_period_id');
    }

    public function project_themes()
    {
        return $this->hasMany('App\Models\ProjectThemes', 'project_id', 'id');
    }

    /* Project attributes */
    public function getPoliticGroupNameAttribute()
    {
        $res = '';
        if ($this->politic_group) {
            $res = $this->politic_group->short_name;
        }

        return $res;
    }

    public function getFunctionaryNameAttribute()
    {
        $res = '';
        if ($this->functionary) {
            $res = $this->functionary->full_name;
        }

        return $res;
    }

    public function getStatusNameAttribute()
    {
        return Self::$statuses[$this->status];
    }

    public function getStatusColorAttribute()
    {
        return Self::$statuses_color[$this->status];
    }

    public function getStatusIconAttribute()
    {
        return Self::$statuses_icon[$this->status];
    }

    public function getThemeNameAttribute()
    {
        $res = 'Sin tema asignado';
        if ($this->project_themes->count() > 0) {
            $res = $this->project_themes()->orderBy('id','DESC')->first()->theme_social->name;
        }
        return $res;
    }

    /* Static functions */
    public static function getProjects($request) 
    {
        $query = Self::select();

        if (isset($request->state_id)) {
            $query = $query->where('state_id', $request->state_id);
        }

        if (isset($request->delegation_id)) {
            $query = $query->where('delegation_id', $request->delegation_id);
        }

        if (isset($request->location_id)) {
            $query = $query->where('location_id', $request->location_id);
        }

        if (isset($request->period_id)) {
            $query = $query->where('period_id', $request->period_id);
        }

        if (isset($request->level_id)) {
            $query = $query->where('level_id', $request->level_id);
        }

        if (isset($request->politic_group_id)) {
            $query = $query->where('politic_group_id', $request->politic_group_id);
        }

        if (isset($request->functionary_type_id)) {
            $query = $query->where('promote_functionary_id', $request->functionary_id);
        }

        if (isset($request->votation_date)) {
            $query = $query->whereDate('votation_date', $request->votation_date);
        }

        if (isset($request->theme_social_id)) {
            $related = \App\Models\ProjectThemes::select('project_id',)->where('theme_social_id',$request->theme_social_id)->get()->toArray();
            if (count($related) > 0) {
                $query = $query->whereIn('id', $related);
            }
        }

        if (isset($request->q)) {
            $string = $request->q;
            $query = $query->where(function($q) use($string){
                $q->where('project_name', 'like', '%'.$string.'%');
                $q->orWhere('description', 'like', '%'.$string.'%');
            });
        }

        return $query;
    }
}
