<?php

namespace App\Traits;

trait Helpers
{
	function objectToArray($object)
    { 
        $result = array();
        foreach ($object as $key => $value)
        {
            $result[$key] = (is_array($value) || is_object($value)) ? $this->objectToArray($value): $value;
        }
        return $result; 
    }

    function serialize($object)
    {
        return json_encode($this->objectToArray($object));
    }
}