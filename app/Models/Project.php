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
}
