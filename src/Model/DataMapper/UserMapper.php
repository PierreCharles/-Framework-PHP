<?php

namespace Model\DataMapper;
use Model\Entity\User;
use Model\DataBase\DatabaseConnection;
use PDO;

class UserMapper {

    private $connection;

    function __construct(DatabaseConnection $connection) {
        $this->connection = $connection;
    }

    function persist(User $user) {
        $request = "INSERT INTO user(user_name, user_password) value(?,?)";
        $param = array(
            '1' => array($user->getUserName(), PDO::PARAM_STR),
            '2' => array($user->getUserPassword(), PDO::PARAM_STR)
        );
        $this->connection->prepareAndExecuteQuery($request, $param);
    }

    function remove($id) {
        $request = "DELETE FROM user WHERE user_id=?";
        $param = array('1'=>array($id, PDO::PARAM_INT));
        $this->connection->prepareAndExecuteQuery($request, $param);
    }
}