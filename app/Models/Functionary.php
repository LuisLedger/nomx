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
        'politic_group_image',
        'functionary_type_name',
        'url_detail',
        'state_name',
        'delegation_name',
        'location_name',
        'commission_name',
        'assistance_today',
        'vote_today'
    ];

    public function level()
    {
        return $this->hasOne('App\Models\Level', 'id', 'level_id');
    }

    public function political_group()
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

    public function functionary_activities()
    {
        return $this->hasMany('App\Models\FunctionaryActivities', 'functionary_id', 'id');
    }

    public function functionary_periods()
    {
        return $this->hasMany('App\Models\FunctionaryPeriod', 'functionary_id', 'id');
    }

    public function functionary_commissions()
    {
        return $this->hasMany('App\Models\FunctionaryCommission', 'functionary_id', 'id');
    }

    public function functionary_social_medias()
    {
        return $this->hasMany('App\Models\FunctionarySocialMedia', 'functionary_id', 'id');
    }

    public function functionary_assistances()
    {
        return $this->hasMany('App\Models\FunctionaryAssistance', 'functionary_id', 'id');
    }

    public function functionary_votes()
    {
        return $this->hasMany('App\Models\FunctionaryVote', 'functionary_id', 'id');
    }

    /* Attributes */
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
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
        if ($this->political_group) {
            $res = $this->political_group->name;
        }

        return $res;
    }

    public function getPoliticGroupImageAttribute()
    {
        $res = '';
        if ($this->political_group) {
            $res = $this->political_group->logo;
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

    public function getStateNameAttribute()
    {
        $res = '';
        if ($this->state) {
            $res = $this->state->name;
        }

        return $res;
    }

    public function getDelegationNameAttribute()
    {
        $res = '';
        if ($this->delegation) {
            $res = $this->delegation->name;
        }

        return $res;
    }

    public function getLocationNameAttribute()
    {
        $res = '';
        if ($this->location) {
            $res = $this->location->name;
        }

        return $res;
    }

    public function getCommissionNameAttribute()
    {
        $res = 'Sin comisi??n asignada';
        if ($this->functionary_commissions()->count() > 0) {
            $res = $this->functionary_commissions->orderBy('id', 'DESC')->first()->commission->name;
        }

        return $res;
    }

    public function getAssistanceTodayAttribute()
    {
        $today = date('Y-m-d');
        $res   = [
            'confirm'   => true,
            'assitance' => 'Asisti??',
            'color'     => 'green',
            'icon'      => 'fa fa-check'
        ];

        $period = $this->functionary_periods()->where('status',1)->first();

        $assistance = null;

        if ($this->functionary_assistances()->count() > 0) {
            $assistance = $this->functionary_assistances()
                ->whereDate('incidence_date', $today)->first();
        }
        

        if (!empty($assistance)) {
            $res   = [
                'confirm'   => false,
                'assitance' => $assistance->assistance_name,
                'color'     => $assistance->assistance_color,
                'icon'      => $assistance->assistance_icon
            ];
        }

        return $res;
    }

    public function getVoteTodayAttribute()
    {
        $today = date('Y-m-d');
        
        $res   = [
            'confirm'   => false,
            'vote_type' => 'Sin votar',
            'color'     => 'gray',
            'icon'      => 'fa fa-ban'
        ];

        $period = $this->functionary_periods()->where('status',1)->first();

        $vote = null;

        if ($this->functionary_votes()->count() > 0) {
            $vote = $this->functionary_votes()
                ->where('level_id', $this->level_id)
                ->whereDate('vote_day', $today)->first();
        }
        

        if (!empty($vote)) {
            $res   = [
                'confirm'   => true,
                'vote_type' => $vote->vote_type->name,
                'color'     => $vote->vote_type->color,
                'icon'      => \App\Models\FunctionaryVote::$icons[$vote->vote_type->id]
            ];
        }

        return $res;
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

        if (isset($request->q)) {
            $string = $request->q;
            $query = $query->where(function($q) use($string){
                $q->where('first_name', 'like', '%'.$string.'%');
                $q->orWhere('last_name', 'like', '%'.$string.'%');
                $q->orWhere('general_description', 'like', '%'.$string.'%');
            });
        }

        return $query;
    }
}
