<?php

namespace Model\Entity;

class User
{
    private $userId,
        $userName,
        $userPassword;

    public function __construct($userId, $userName, $userPassword)
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->userPassword = $userPassword;
    }

    public function getUserName()
    {
        return $this->userName;
    }
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUserPassword()
    {
        return $this->userPassword;
    }

    public function __toString()
    {
        return 'id:'.$this->getUserId().', name:'.$this->getUserName();
    }
}
