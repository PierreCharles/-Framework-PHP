<?php

namespace Model\DataMapper;

use Model\Entity\User;
use Model\DataBase\DatabaseConnection;

class UserMapper {

    private $connection;

    function __construct(DatabaseConnection $connection) {
        $this->connection = $connection;
    }

    function persist(User $user) {
        $request = 'INSERT INTO user(user_name, user_password) value(:name,:password)';
        $this->connection->prepareAndExecuteQuery($request, ['name'=>$user->getUserName(), 'password'=>$user->getUserPassword()]);
    }

    function remove($id) {
        $request = 'DELETE FROM user WHERE user_id=:id';
        $this->connection->prepareAndExecuteQuery($request, ['id',$id]);
    }
}