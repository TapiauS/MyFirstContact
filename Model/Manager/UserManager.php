<?php


class UserManager{

    private static ?PDO $connexion=null;

    public static function init():void {
        if(self::$connexion===null)
            self::$connexion = Connect::getInstance()->getConnexion();
    }

    public static function getUsers():array{
        self::init();
        $sql="SELECT id,pseudo,password FROM users";
        $stmt=self::$connexion->prepare($sql);
        $stmt->execute();
        $results=array();
        while($row=$stmt->fetch()){
            var_dump($row);
            $user=new User($row["pseudo"],$row["password"],$row["id"]);
            array_push($results,$user);
        }
        return $results;
    }

    public static function newUser(String $pseudo,String $password):User|null{
        try{
            self::init();
            $hashedpassWord=password_hash($password,PASSWORD_BCRYPT);
            $sql="INSERT INTO users(pseudo,password) VALUES (?,?) RETURNING id";
            $stmt=self::$connexion->prepare($sql);
            $stmt->bindValue(1,$pseudo,PDO::PARAM_STR);
            $stmt->bindValue(2,$hashedpassWord,PDO::PARAM_STR);
            $stmt->execute();
            $id=null;
            if($row=$stmt->fetch()){
                $id=$row["id"];
            }
            return new User($pseudo,$password,$id);
        }
        catch(PDOException $pdoe){
            echo "carte bleue svp";
            
            return null;
        }
    }

    public static function connectUser(String $pseudo,String $password):User|null{
        try{
            self::init();
            $sql="SELECT id,password FROM users WHERE pseudo=?";
            var_dump(self::$connexion);
            $stmt=self::$connexion->prepare($sql);
            $stmt->bindValue(1,$pseudo,PDO::PARAM_STR);
            $stmt->execute();
            if($row=$stmt->fetch())
            {
                if(password_verify($password,$row["password"])):
                    $user=new User($pseudo,$password,$row["id"]);
                    ContactManager::getAllContacts($row["id"]);
                    return $user;
                else:
                    return null;   
                endif;    
            } 
            else
                return null;
        }
        catch(PDOException $pdoe){
            echo "carte bleue svp";
        }
    }
}

