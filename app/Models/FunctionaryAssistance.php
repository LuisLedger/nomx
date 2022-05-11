<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionaryAssistance extends Model
{
    use HasFactory;

    public static $statuses = [
        1 => 'No en curúl',
        2 => 'No asistió',
    ];

    public static $statuses_color = [
        1 => 'red',
        2 => 'gray',
    ];

    public static $statuses_icon = [
        1 => 'fa fa-circle-o',
        2 => 'fa fa-times',
    ];

    protected $appends = [
        'assistance_name',
        'assistance_color',
        'assistance_icon'
    ];

    public function period()
    {
        return $this->hasOne('App\Models\Period', 'id', 'period_id');
    }

    public function functionary()
    {
        return $this->hasOne('App\Models\Functionary', 'id', 'functionary_id');
    }

    public function getAssistanceNameAttribute()
    {
        return self::$statuses[ $this->incidence_id ];
    }

    public function getAssistanceColorAttribute()
    {
        return self::$statuses_color[ $this->incidence_id ];
    }

    public function getAssistanceIconAttribute()
    {
        return self::$statuses_icon[ $this->incidence_id ];
    }
}