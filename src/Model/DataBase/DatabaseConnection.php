<?php

namespace Model\DataBase;

use PDO;

class DatabaseConnection extends PDO {
    /**
     * Database connection
     * $host        = Host
     * $base        = Database name
     * $login       = Database username
     * $mdp         = Database password
     * $statement   = a statement
     */
    private
        $statement,
        $base = "TweetTweet",
        $login="root",
        $mdp="",
        $host="localhost";

    // Constructor of a database connection
    public function __construct() {
        parent::__construct('mysql:host='.$this->host.';dbname='.$this->base,$this->login,$this->mdp);
    }

    // Metho to prepare and execute a query
    public function prepareAndExecuteQuery($requete, $param){
        $this->statement = $this->prepare($requete);
        if (isset($param) && $param!=null) {
            for ($i = 1; $i <= count($param); $i++) {
                $this->statement->bindParam($i, $param[$i][0], $param[$i][1]);
            }
        }
        $this->statement->execute();
    }

    // get result
    public function getResult(){
        return $this->statement->fetchAll();
    }

    // Destroy statement
    public function destroyQueryResults(){
        $this->statement->closeCursor();
        $this->statement=NULL;
    }
}