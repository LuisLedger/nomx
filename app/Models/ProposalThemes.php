<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalThemes extends Model
{
    use HasFactory;

    public function proposal()
    {
        return $this->hasOne('App\Models\Proposal', 'id', 'proposal_id');
    }

    public function theme_social()
    {
        return $this->hasOne('App\Models\ThemeSocial', 'id', 'theme_social_id');
    }
}
