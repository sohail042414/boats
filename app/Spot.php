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

    /**
     * 
     */
    public function getList(){
        $items = $this->all();
        $data = [];
        foreach($items as $item){
            $data[$item->id] = $item->name;
        }
        return $data;
    }
}
