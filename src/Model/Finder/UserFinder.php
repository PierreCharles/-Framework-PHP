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
        $request = 'SELECT * FROM USER WHERE user_id=:id';
        $this->connection->prepareAndExecuteQuery($request, ['id' => $id]);
        $result = $this->connection->getResult();
        $this->connection->destroyQueryResults();

        return count($result) == 0 ? null : new User($result[0]['user_id'], $result[0]['user_name'], $result[0]['user_password']);
    }

    public function findOneByUserName($user)
    {
        $request = 'SELECT * FROM USER WHERE user_name=:name';
        $this->connection->prepareAndExecuteQuery($request, ['name' => $user]);
        $result = $this->connection->getResult();
        $this->connection->destroyQueryResults();

        return count($result) == 0 ? null : new User($result[0]['user_id'], $result[0]['user_name'], $result[0]['user_password']);
    }
}
