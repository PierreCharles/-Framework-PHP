<?php

namespace ModelTest\DataMapperTest;

use Model\DataBase\DatabaseConnection;
use Model\DataMapper\StatusMapper;
use Model\Entity\Status;
use TestCase;
use PDO;

class StatusDataMapperTest extends TestCase
{
    private $connection;

    public function setUp()
    {
        $this->connection = new DatabaseConnection('sqlite::memory:');
        $this->connection->exec(<<<SQL
CREATE TABLE IF NOT EXISTS STATUSES (
  status_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  status_message VARCHAR(140) NOT NULL,
  status_user_name VARCHAR(100),
  status_date DATETIME NOT NULL
);
SQL
        );
    }

    public function testPersist()
    {
        $mapper = new StatusMapper($this->connection);
        $rows = $this->connection->query('SELECT COUNT(*) FROM STATUSES')->fetch(PDO::FETCH_NUM);
        $this->assertEquals(0, $rows[0]);
        $status = new Status("1", 'picharles', 'message', date('Y-m-d H:i:s'));
        $mapper->persist($status);
        $rows = $this->connection->query('SELECT COUNT(*) FROM STATUSES')->fetch(PDO::FETCH_NUM);
        $this->assertEquals(1, $rows[0]);
    }


    public function testRemove()
    {
        $mapper = new statusMapper($this->connection);
        $rows = $this->connection->query('SELECT COUNT(*) FROM STATUSES')->fetch(\PDO::FETCH_NUM);
        $this->assertEquals(0, $rows[0]);
        $status = new Status("1", 'picharles', 'message', date('Y-m-d H:i:s'));
        $mapper->persist($status);
        $rows = $this->connection->query('SELECT COUNT(*) FROM STATUSES')->fetch(\PDO::FETCH_NUM);
        $this->assertEquals(1, $rows[0]);
        $mapper->remove($status);
        $rows = $this->connection->query('SELECT COUNT(*) FROM STATUSES')->fetch(\PDO::FETCH_NUM);
        $this->assertEquals(0, $rows[0]);
    }
}