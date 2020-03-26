<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CruiseCategory;
use App\ShipType;

class Ship extends Model
{
    //

    public function shipType()
    {
        return $this->belongsTo(ShipType::class, 'ship_type', 'id');
    }

    public function cruiseCategory()
    {
        return $this->belongsTo(CruiseCategory::class, 'cruise_category', 'id');
    }


}
