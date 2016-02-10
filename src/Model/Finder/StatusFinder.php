<?php

namespace Model\Finder;

use Model\DataBase\DatabaseConnection;
use Model\Entity\Status;

class StatusFinder implements FinderInterface
{
    private $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll()
    {
        $query = 'SELECT * FROM statuses';
        $this->connection->prepareAndExecuteQuery($query, []);
        $results = $this->connection->getResult();
        $this->connection->destroyQueryResults();
        $statuses = array();
        foreach ($results as $status) {
            $statuses[] = new Status($status['status_id'], $status['status_user_name'], $status['status_message'], $status['status_date']);
        }

        return $statuses;
    }

    public function findOneById($id)
    {
        $query = 'SELECT * FROM statuses WHERE status_id=:id';
        $this->connection->prepareAndExecuteQuery($query, ['id' => $id]);
        $result = $this->connection->getResult()[0];
        $this->connection->destroyQueryResults();

        return new Status($result['status_id'], $result['status_message'], $result['status_user_name'], $result['status_date']);
    }
}
