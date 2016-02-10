<?php

namespace Model\Finder;

use Model\DataBase\DatabaseConnection;
use Model\Entity\User;

class UserFinder
{
    private $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function findOneById($id)
    {
        $request = 'SELECT * FROM user WHERE user_id=:id';
        $this->connection->prepareAndExecuteQuery($request, ['id' => $id]);
        $result = $this->connection->getResult()[0];
        $this->connection->destroyQueryResults();

        return !count($result) == 0 ? new User($result['user_id'], $result['user_name'], $result['user_password']) : null;
    }

    public function findOneByUserName($user)
    {
        $request = 'SELECT * FROM user WHERE user_name=:name';
        $this->connection->prepareAndExecuteQuery($request, ['name' => $user]);
        $result = $this->connection->getResult()[0];
        $this->connection->destroyQueryResults();

        return !count($result) == 0 ? new User($result['user_id'], $result['user_name'], $result['user_password']) : null;
    }
}
