<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    public static $statuses = [
        0 => 'Deshechado',
        1 => 'Cumplido',
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
        'theme_name'
    ];


    public function proposal_themes()
    {
        return $this->hasMany('App\Models\ProposalThemes', 'proposal_id', 'id');
    }

    /*Attributes*/
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
        if ($this->proposal_themes->count() > 0) {
            $res = $this->proposal_themes()->orderBy('id','DESC')->first()->theme_social->name;
        }
        return $res;
    }

    /* Static functions */
    public static function getProposals($request) 
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

        if (isset($request->theme_social_id)) {
            $related = \App\Models\ProposalThemes::select('proposal_id',)->where('theme_social_id',$request->theme_social_id)->get()->toArray();
            if (count($related) > 0) {
                $query = $query->whereIn('id', $related);
            }
        }

        if (isset($request->q)) {
            $string = $request->q;
            $query = $query->where(function($q) use($string){
                $q->where('proposal_name', 'like', '%'.$string.'%');
                $q->orWhere('description', 'like', '%'.$string.'%');
            });
        }

        return $query;
    }
}
