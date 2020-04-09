<?php

namespace App;

use Carbon;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    //
    protected $dates = ['start_date','end_date'];

    public function setStartDateAttribute($date)
    {
        $this->attributes['start_date'] = Carbon::parse($date);
    }

    public function setEndDateAttribute($date)
    {
        $this->attributes['end_date'] = Carbon::parse($date);
    }

}
