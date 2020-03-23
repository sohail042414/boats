<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BoatClass;
use App\BoatType;

class Boat extends Model
{
    //

    public function type()
    {
        return $this->belongsTo(BoatType::class, 'type', 'id');
    }

    public function class()
    {
        return $this->belongsTo(BoatClass::class, 'type', 'id');
    }


}
