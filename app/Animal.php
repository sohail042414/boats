<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    //

    public $types = [
        'animal' => 'Animal',
        'bird' => 'Bird'
    ];

    public function animalTypes(){
        return $this->types;
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

    /**
     * 
     */
    public function spots()
    {
        return $this->belongsToMany('App\Spot','spot_animals');
    }
}
