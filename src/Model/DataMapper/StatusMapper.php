<?php

namespace Model\DataMapper;

use Model\DataBase\DatabaseConnection;
use Model\Entity\Status;

class StatusMapper
{
    private $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function persist(Status $status)
    {
        $request = 'INSERT INTO statuses(status_message,status_user_name,status_date) value(:message,:user,:date)';
        $this->connection->prepareAndExecuteQuery($request, [
            'message' => $status->getMessage(),
            'us' => $status->getUser(),
            'date' => $status->getDate(),
        ]);
    }

    public function remove($id)
    {
        $request = 'DELETE FROM statuses WHERE status_id=:id';
        $this->connection->prepareAndExecuteQuery($request, ['id' => $id]);
    }
}
