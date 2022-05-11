<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleSession extends Model
{
    use HasFactory;


    public static function getSchedule(Request $request)
    {
        $query = Self::select('*');

        if (isset($request->today)) {
            $query = $query->whereDate('session_date', $request->today);
        }

        if (isset($request->start_date)) {
            $query = $query->whereDate('session_date','>=', $request->start_date);
        }

        if (isset($request->end_date)) {
            $query = $query->whereDate('end_date','<=', $request->end_date);
        }

        if (isset($request->functionary_type_id)) {
            $query = $query->whereDate('functionary_type_id', $request->functionary_type_id);
        }

        if (isset($request->level_id)) {
            $query = $query->whereDate('level_id', $request->level_id);
        }

        if (isset($request->period_id)) {
            $query = $query->whereDate('period_id', $request->period_id);
        }

        return $query;
    }
}
