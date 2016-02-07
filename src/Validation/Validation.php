<?php
namespace Validation;;

class Validation
{
    static function isInt($value)
    {
        return (isset($value) && is_int($value)) != true ? true : false;
    }

    static function verifyMessageStatuses($message)
    {
        $error = 0;
        if (strlen($message) >= 140) {
            $error = "Your message exceeds 140 characters !";
        }
        return $error;
    }
}

