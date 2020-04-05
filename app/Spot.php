<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    //
    public function animals()
    {
        return $this->belongsToMany('App\Animal','spot_animals');
    }
}
