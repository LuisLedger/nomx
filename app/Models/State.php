<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
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

    public function delegations()
    {
        return $this->hasMany('App\Models\Delegation', 'state_id', 'id');
    }

    public function getStatusNameAttribute()
    {
        // return Self::$statuses[$this->status];
    }

    public function getStatusColorAttribute()
    {
        // return Self::$statuses_color[$this->status];
    }
}
