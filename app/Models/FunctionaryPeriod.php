<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionaryPeriod extends Model
{
    use HasFactory;

    protected $appends = [
        'full_period',
    ];

    public function period()
    {
        return $this->hasOne('App\Models\Period', 'id', 'period_id');
    }

    public function functionary()
    {
        return $this->hasOne('App\Models\Functionary', 'id', 'functionary_id');
    }

    public function functionary_type()
    {
        return $this->hasOne('App\Models\FunctionaryType', 'id', 'functionary_type_id');
    }

    /* Attributes */
    public function getFullPeriodAttribute()
    {
        $res = '';
        if ($this->period) {
            $res = $this->period->start_year.'-'.$this->period->end_year;
        }

        if ($this->functionary_type) {
            $res .= ' '.$this->functionary_type->name;
        }

        return $res;
    }
}
