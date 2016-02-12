<?php

use Model\Finder\UserFinder;
use Model\DataBase\DatabaseConnection;
use Model\Entity\User;

class UserFinderTest extends TestCase
{
    private $connection;
    private $finder;
    public function setUp()
    {
        $this->con = new DatabaseConnection('sqlite::memory:');
        $this->con->exec(<<<SQL
CREATE TABLE IF NOT EXISTS USER (
      user_id INT PRIMARY KEY NOT NULL,
      user_name VARCHAR(100) NOT NULL,
      user_password VARCHAR(100) NOT NULL
);

INSERT INTO `user` (`user_id`, `user_name`, `user_password`) VALUES
(1, 'UserTest', 'PasswordTest');
SQL
        );
        $this->finder = new UserFinder($this->connection);
    }

    public function testFindOneByIdCount()
    {
        $user = $this->finder->findOneById(1);
        $this->assertEquals(1, count($user));
    }

    public function testFindOneById()
    {
        $expected = new User('1', 'UserTest', 'PasswordTest');
        $user = $this->finder->findOneById(1);
        $this->assertEquals($expected, $user);
    }

    public function testFindOneByUserNameCount()
    {
        $user = $this->finder->findOneByName('UserTest');
        $this->assertEquals(1, count($user));
    }

    public function testFindOneByName()
    {
        $expected = new User('1', 'UserTest', 'PasswordTest');
        $user = $this->finder->findOneByUserName('UserTest');
        $this->assertEquals($expected, $user);
    }
}
