<?php

namespace Model\DataBase;

use PDO;

class DatabaseConnection extends PDO
{
    private $statement;

    public function prepareAndExecuteQuery($query, array $parameters = [])
    {
        $this->statement = $this->prepare($query);
        foreach ($parameters as $name => $value) {
            $this->statement->bindValue(':'.$name, $value);
        }
        $this->statement->execute();
        //var_dump($this->statement->errorInfo());
    }

    public function getResult()
    {
        return $this->statement->fetchAll();
    }

    public function destroyQueryResults()
    {
        $this->statement->closeCursor();
        $this->statement = null;
    }
}
