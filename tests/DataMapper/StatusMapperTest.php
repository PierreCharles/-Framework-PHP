<?php
namespace DataMapper;

use Mock\MockConnection;
use Model\DataMapper\StatusMapper;
use Model\Entity\Status;
use TestCase;

class StatusMapperTest extends TestCase{

    private $connection;
    private $mapper;

    public function setUp(){
        $this->connection = $this->getMock('Mock\MockConnection');
        $this->mapper = new StatusMapper($this->connection);
        $this->connection
            ->expects($this->once())
            ->method('prepareAndExecuteQuery');
    }
    public function testPersist(){
        $status = new Status("sqg", "picharles", 'message', date('Y-m-d H:i:s'));
        $this->assertTrue($this->mapper->persist($status));
    }

    public function testRemove(){
        $status = new Status("1", 'picharles', 'message', date('Y-m-d H:i:s'));
        $this->assertTrue($this->mapper->remove($status));
    }
}