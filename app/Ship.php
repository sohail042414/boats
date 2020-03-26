<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CruiseCategory;
use App\ShipType;
use App\Amenity;

class Ship extends Model
{
    //

    public function shipType()
    {
        return $this->belongsTo(ShipType::class, 'ship_type', 'id');
    }

    public function amenities()
    {
        return $this->belongsToMany('App\Amenity','ship_amenities');
    }

    public function cruiseCategory()
    {
        return $this->belongsTo(CruiseCategory::class, 'cruise_category', 'id');
    }


}
