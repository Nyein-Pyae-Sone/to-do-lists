<?php

class Validator
{
    public static function string($values, $min = 1, $max = INF )
    {
        if(!is_string($values)){
            return false;
        }
        
        $values = trim($values);
        return strlen($values) >= $min && strlen($values) <= $max;
    }
}