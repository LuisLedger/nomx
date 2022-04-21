<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function delegation()
    {
        return $this->hasOne('App\Models\Locations\Delegation', 'id', 'delegation_id');     
    }
}
