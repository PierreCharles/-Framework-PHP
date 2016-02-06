<?php
namespace Validation;;

class Validation
{
    static function isInt($value)
    {
        return (isset($value) && is_int($value)) != true ? true : false;
    }
}

