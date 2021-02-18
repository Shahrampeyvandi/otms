<?php

if (! function_exists('set_date')) {
 function set_date(string $date)
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
