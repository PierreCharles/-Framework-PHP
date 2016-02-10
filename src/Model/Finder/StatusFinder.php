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

    public function findAll($criteria)
    {
        if (empty($criteria['by'])) {
            $criteria['by'] = 'DESC';
        }
        empty($criteria['order']) ? $criteria['orderBy'] = '' : $criteria['orderBy'] = 'ORDER BY '.$criteria['order'].' '.$criteria['by'];
        empty($criteria['limit']) ? '' : $criteria['limit'] = 'LIMIT '.$criteria['limit'];
        empty($criteria['user_id']) ? '' : $criteria['user_id'] = "WHERE status_user_name = '".$criteria['user_id']."'";
        $query = 'SELECT * FROM statuses '.$criteria['user_id'].' '.$criteria['orderBy'].' '.$criteria['limit'];

        $this->connection->prepareAndExecuteQuery($query);
        $results = $this->connection->getResult();
        $this->connection->destroyQueryResults();
        if (count($results) == 0) {
            return;
        }
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
        $result = $this->connection->getResult();
        $this->connection->destroyQueryResults();

        return count($result) == 0 ? null : new Status(
            $result[0]['status_id'],
            $result[0]['status_message'],
            $result[0]['status_user_name'],
            $result[0]['status_date']);
    }
}
