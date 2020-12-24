<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Holiday extends Model
{
    protected $fillable = ['date'];

    protected $guarded = ['id'];
    protected $dates = ['date'];

    public static function getHolidayByDates($startDate, $endDate){

        return Holiday::select(DB::raw('DATE_FORMAT(date, "%Y-%m-%d") as holiday_date'), 'occassion')->where('date', '>=', $startDate)->where('date', '<=', $endDate)->get();
    }

    public static function checkHolidayByDate($date){
        return Holiday::Where('date', $date)->first();
    }
}
