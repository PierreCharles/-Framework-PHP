<?php

namespace Model\Finder;

use Model\DataBase\DatabaseConnection;
use Model\Entity\User;

use PDO;

class UserFinder{

    private $connection;

    function __construct(DatabaseConnection $connection) {
        $this->connection = $connection;
    }

    public function findOneById($id) {
        $request = "SELECT * FROM user WHERE user_id=?";
        $param=array('1'=>array($id,PDO::PARAM_INT));
        $this->connection->prepareAndExecuteQuery($request, $param);
        $result = $this->connection->getResult()[0];
        $this->connection->destroyQueryResults();
        return !count($result)==0 ? new User($result['user_id'], $result['user_name'], $result['user_password']) : null;
    }

    public function findOneByUserName($userName) {
        $request = "SELECT * FROM user WHERE user_name=?";
        $param = array('1'=>array($userName,PDO::PARAM_STR));
        $this->connection->prepareAndExecuteQuery($request, $param);
        $result = $this->connection->getResult()[0];
        $this->connection->destroyQueryResults();
        return !count($result)==0 ? new User($result['user_id'], $result['user_name'], $result['user_password']) : null;
    }

}