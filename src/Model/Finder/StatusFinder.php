<?php

namespace Model\Finder;

use Model\DataMapper\StatusMapper;
use Model\DataBase\DatabaseConnection;
use Model\Entity\Status;
use PDO;

class StatusFinder implements FinderInterface
{

    private $connection;
    private $statusMapper;

    function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
        $this->statusMapper = new StatusMapper($connection);
    }

    public function findAll()
    {
        $request = "SELECT * FROM statuses";
        $this->connection->prepareAndExecuteQuery($request, null);
        $results = $this->connection->getResult();
        $this->connection->destroyQueryResults();
        $statuses = array();
        foreach ($results as $status) {
            $statuses[] = new Status($status['status_id'], $status['status_message'], $status['status_user_id'], $status['status_date']);
        }
        return $statuses;
    }

    public function findOneById($id)
    {
        $request = "SELECT * FROM statuses WHERE status_id=?";
        $param = array('1' => array($id, PDO::PARAM_INT));
        $this->connection->prepareAndExecuteQuery($request, $param);
        $result = $this->connection->getResult()[0];
        $this->connection->destroyQueryResults();
        return new Status($result['status_id'], $result['status_message'], $result['status_user_id'], $result['status_date']);
    }

    public function addStatus($user, $message)
    {
        $status = new Status(null, $user, $message, date("Y-m-d H:i:s"));
        $this->statusMapper->persist($status);
    }

    public function deleteStatus($id)
    {
        echo $id;
        if (!$this->findOneById($id)) {
            return -1;
        }
        $this->statusMapper->remove($id);
    }
}