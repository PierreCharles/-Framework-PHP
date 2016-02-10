<?php

namespace Mock;

use Model\DataBase\DatabaseConnection;

class MockConnection extends DatabaseConnection
{
    public function __construct(){
        parent::__construct();
    }
}