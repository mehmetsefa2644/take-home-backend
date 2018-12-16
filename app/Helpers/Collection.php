<?php

namespace App\Helpers;

class Collection
{
    public static function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
    }
}