<?php

namespace Model\Entity;

use DateTime;

class Status {

    private $user,$message,$date;

    public function __construct($id, $user, $message, $date)
    {
        $this->id=$id;
        $this->user=$user;
        $this->message=$message;
        $this->date = new DateTime($date);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getDate()
    {
        return $this->date->format('Y-m-d H:i:s');
    }

    public function toString(){
        return "id:".$this->getId().", user:".$this->getUser().",message: ".$this->getMessage().",date: ".$this->getDate();
    }
}