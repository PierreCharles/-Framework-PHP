<?php

namespace Model\DataMapper;

use Model\DataBase\DatabaseConnection;
use Model\Entity\Status;
use PDO;

class StatusMapper{

    private $connection;

    public function __construct(DatabaseConnection $connection) {
        $this->connection = $connection;
    }

    public function persist(Status $status) {
        $request = "INSERT INTO statuses(status_message,status_user_name,status_date) value(?,?,?)";
        $param = array(
            '1' => array($status->getMessage(), PDO::PARAM_STR),
            '2' => array($status->getUser(), PDO::PARAM_STR),
            '3' => array($status->getDate(), PDO::PARAM_STR)
        );
        $this->connection->prepareAndExecuteQuery($request, $param);
    }

    public function remove($id) {
        $request = "DELETE FROM statuses WHERE status_id=?";
        $param = array('1'=>array($id, PDO::PARAM_INT));
        $this->connection->prepareAndExecuteQuery($request, $param);
    }
}