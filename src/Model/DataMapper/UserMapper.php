<?php

namespace Model\DataMapper;

use Model\DataBase\DatabaseConnection;

class UserMapper implements DataMapperInterface
{
    private $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function persist($user)
    {
        $request = 'INSERT INTO USER(user_name, user_password) VALUES (:name,:password)';
        $this->connection->prepareAndExecuteQuery($request, ['name' => $user->getUserName(), 'password' => $user->getUserPassword()]);
    }

    public function remove($id)
    {
        $request = 'DELETE FROM USER WHERE user_id=:id';
        $this->connection->prepareAndExecuteQuery($request, ['id', $id]);
    }
}
