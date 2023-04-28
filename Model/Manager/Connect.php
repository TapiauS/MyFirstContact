<?php 
class Connect{

    private static ?Connect $instance=null;

    private ?PDO $connexion;

    private function __construct()
    {
        try{
            $dsn="pgsql:host=10.113.28.39;port=5432;dbname=contactappsimon";
            $user="stapiau";
            $mdp="Afpa54*";
            $this->connexion=new PDO($dsn,$user,$mdp);
        }
        catch(PDOException $pdoe){
            echo "cassé";
        }
    }

    public static function getInstance():Connect{
        if(is_null(self::$instance))
            self::$instance=new Connect();
        return  self::$instance;
    }

    public function getConnexion(){
        return $this->connexion;
    }

}

$connexiontest=Connect::getInstance()->getConnexion();


