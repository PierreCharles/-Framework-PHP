<?php

namespace Model;

class DatabaseConnection {
    /**
     * Database connection
     * $host        = Host
     * $base        = Database name
     * $login       = Database username
     * $mdp         = Database password
     * $statement   = a statement
     */
    private
        $dbh=null,
        $statement,
        $base = "TweetTweet",
        $login="root",
        $mdp="",
        $host="localhost";

    // Constructor of a database connection
    public function __construct() {
        self::$dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->base.'',$this->login,$this->mdp);
    }

    // Metho to prepare and execute a query
    public function prepareAndExecuteQuerySelect($requete, $param){
        self::$statement = self::$dbh->prepare($requete);
        if (isset($param) && $param!=null) {
            for ($i = 1; $i <= count($param); $i++) {
                self::$statement->bindParam($i, $param[$i][0], $param[$i][1]);
            }
        }
        self::$statement->execute();
    }

    // get result
    public static function getResult(){
        return self::$statement->fetchAll();
    }
    // Destroy statement
    public static function destroyQueryResults(){
        self::$statement->closeCursor();
        self::$statement=NULL;
    }
}