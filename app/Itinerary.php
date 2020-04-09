<?php

namespace App;

use Carbon;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    //
    protected $dates = ['start_date','end_date'];

    //
    public function getList(){
        $items = $this->all();
        $data = [];
        foreach($items as $item){
            $data[$item->id] = $item->code." : ".$item->title;
        }
        return $data;
    }

    public function spots()
    {
        return $this->belongsToMany('App\Spot','itinerary_spots');
    }

    public function setStartDateAttribute($date)
    {
        $this->attributes['start_date'] = Carbon::parse($date);
    }

    public function setEndDateAttribute($date)
    {
        $this->attributes['end_date'] = Carbon::parse($date);
    }
}
