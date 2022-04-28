<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionaryAssistance extends Model
{
    use HasFactory;

    public function period()
    {
        return $this->hasOne('App\Models\Period', 'id', 'period_id');
    }

    public function functionary()
    {
        return $this->hasOne('App\Models\Functionary', 'id', 'functionary_id');
    }
}
