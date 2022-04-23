<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegation extends Model
{
    use HasFactory;

    public static $statuses = [
        0 => 'Inactivo',
        1 => 'Activo',
    ];

    public static $statuses_color = [
        0 => 'gray',
        1 => 'green',
    ];

    protected $appends = [
        'status_name',
        'status_color',
    ];

    public function state()
    {
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }

    public function location()
    {
        return $this->hasOne('App\Models\Location', 'id', 'delegation_id');
    }

    public function locations(){
        return $this->hasMany('App\Models\Location', 'delegation_id', 'id');
    }

    public function getStatusNameAttribute()
    {
        return Self::$statuses[$this->status];
    }

    public function getStatusColorAttribute()
    {
        return Self::$statuses_color[$this->status];
    }
}
