<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Island extends Model
{
    //

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
