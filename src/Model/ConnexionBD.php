<?php
class connexionBD {
    /**
     * Database connection
     * $host        = Host
     * $base        = Database name
     * $login       = Database username
     * $mdp         = Database password
     */
    private
        $dbh=null,
        $statement,
        $base = "TweetTweet",
        $login="root",
        $mdp="",
        $host="localhost";

    // Constructor of a database connection
    private function __construct() {
        self::$dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->base.'',$this->login,$this->mdp);
    }

    // Méthode de préparation et d'éxéution d'une requete. -> Remplace les ? de la requete.
    public function prepareAndExecuterQuerySelect($requete, $param){
        self::$statement = self::$dbh->prepare($requete);
        if (isset($param) && $param!=null) {
            for ($i = 1; $i <= count($param); $i++) {
                self::$statement->bindParam($i, $param[$i][0], $param[$i][1]);
            }
        }
        self::$statement->execute();
    }

    // Methode de récuperation des resultats.
    public static function getResult(){
        return self::$statement->fetchAll();
    }
    // Methode de destruction du statement.
    public static function destroyQueryResults(){
        self::$statement->closeCursor();
        self::$statement=NULL;
    }
}