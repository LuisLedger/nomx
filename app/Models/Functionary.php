<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Functionary extends Model
{
    use HasFactory;

    protected $appends = [
        'full_name',
        'level_name',
        'politic_group_name',
        'functionary_type_name',
        'url_detail',
    ];


    public function level()
    {
        return $this->hasOne('App\Models\Level', 'id', 'level_id');
    }

    public function politic_group()
    {
        return $this->hasOne('App\Models\PoliticGroup', 'id', 'politic_group_id');
    }

    public function functionary_type()
    {
        return $this->hasOne('App\Models\FunctionaryType', 'id', 'functionary_type_id');
    }

    public function district()
    {
        return $this->hasOne('App\Models\District', 'id', 'district_id');
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
        return $this->hasOne('App\Models\Location', 'id', 'location_id');
    }

    public function functionary_contacts()
    {
        return $this->hasMany('App\Models\FunctionaryContact', 'functionary_id', 'id');
    }

    /* Attributes */
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->middle_name.' '.$this->last_name;
    }

    public function getLevelNameAttribute()
    {
        $res = '';
        if ($this->level) {
            $res = $this->level->name;
        }

        return $res;
    }

    public function getPoliticGroupNameAttribute()
    {
        $res = '';
        if ($this->politic_group) {
            $res = $this->politic_group->name;
        }

        return $res;
    }

    public function getFunctionaryTypeNameAttribute()
    {
        $res = '';
        if ($this->functionary_type) {
            $res = $this->functionary_type->name;
        }

        return $res;
    }

    public function getUrlDetailAttribute()
    {
        $res = '';
        return url('functionary/'.$this->id.'/detail');
    }

    /* Static functions */

    public static function getFunctionaries($request) 
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

        if (isset($request->district_id)) {
            $query = $query->where('district_id', $request->district_id);
        }

        if (isset($request->level_id)) {
            $query = $query->where('level_id', $request->level_id);
        }

        if (isset($request->politic_group_id)) {
            $query = $query->where('politic_group_id', $request->politic_group_id);
        }

        if (isset($request->functionary_type_id)) {
            $query = $query->where('functionary_type_id', $request->functionary_type_id);
        }

        return $query;
    }
}
