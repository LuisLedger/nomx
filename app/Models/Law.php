<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Law extends Model
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
    ];

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
