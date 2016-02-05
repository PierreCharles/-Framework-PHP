<?php

namespace Model\Entity;

class Status {

    private $user,$message,$date;
    
    public function __construct($user, $message, $date)
    {
        $this->user=$user;
        $this->message=$message;
        $this->date=$date;
    }

    public function getMessage()
    {
        return $this->message;
    }


    public function getDate()
    {
        return $this->date;
    }

    public function getUser()
    {
        return $this->user;
    }


}