<?php
namespace Model\Entity;

class User {

    private
        $userId,
        $userName,
        $userPassword;

    function __construct($userId, $userName, $userPassword) {
        $this->userId = $userId;
        $this->userName=$userName;
        $this->userPassword = $userPassword;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUserPassword()
    {
        return $this->userPassword;
    }

}