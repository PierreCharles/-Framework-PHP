<?php

use Model\DataBase\DatabaseConnection;
use Model\Finder\StatusFinder;
use Model\Entity\Status;

class StatusFinderTest extends TestCase
{
    private $connection;
    private $finder;
    private $filter;

    public function setUp()
    {
        $this->connection = new DatabaseConnection('sqlite::memory:');
        $this->connection->exec(<<<SQL
CREATE TABLE IF NOT EXISTS STATUSES (
  status_id INT PRIMARY KEY NOT NULL,
  status_message VARCHAR(140) NOT NULL,
  status_user_name VARCHAR(100),
  status_date DATETIME NOT NULL
);

INSERT INTO `statuses` (`status_id`, `status_message`, `status_user_name`, `status_date`) VALUES
(1, 'Mon premier tweet !', 'UserTest', '2016-02-11 00:19:39');
SQL
        );
        $this->finder = new StatusFinder($this->connection);
        $this->filter['order'] = "";
        $this->filter['by'] = "";
        $this->filter['limit'] = "";
        $this->filter['user_id'] = "";
    }

    public function testCountFindAll()
    {
        $statuses = $this->finder->findAll($this->filter);
        $this->assertEquals(1, count($statuses));
    }

    public function testFindAll()
    {
        $expected = new Status(1, 'UserTest', 'Mon premier tweet !', date('2016-02-11 00:19:39'));
        $statuses = $this->finder->findAll($this->filter);
        $this->assertEquals($expected, $statuses[0]);
    }

    public function testCountFindOneById()
    {
        $status = $this->finder->findOneById(1);
        $this->assertEquals(1, count($status));
    }

    public function testFindOneById()
    {
        $expected = new Status(1, 'Mon premier tweet !', 'UserTest', date('2016-02-11 00:19:39'));
        $status = $this->finder->findOneById(1);
        $this->assertEquals($expected, $status);
    }
}
