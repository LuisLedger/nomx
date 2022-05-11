<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionaryVote extends Model
{
    use HasFactory;

    public static $icons = [
        1 => 'fa fa-thumbs-o-up',
        2 => 'fa fa-thumbs-o-down',
        3 => 'fa fa-hand-rock-o',
    ];

    public function functionary()
    {
        return $this->hasOne('App\Models\VoteType', 'id', 'vote_type_id');
    }

    public function vote_type()
    {
        return $this->hasOne('App\Models\VoteType', 'id', 'vote_type_id');
    }
}
