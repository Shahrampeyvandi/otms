<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoadData extends Model
{

    protected $guarded = ['id'];

    public function set_date($date)
    {
        if($date){
        $explode = explode('/',$date);
        // dd($explode);
        $d = $explode[0];
        $m = $explode[1];
        $y = $explode[2];
        return "$y-$m-$d";
        }
        return '';

    }
}
