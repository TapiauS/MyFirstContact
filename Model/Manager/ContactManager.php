<?php

class ContactManager{
    private static ?PDO $connect=null;

    public static function init(){
        if(!is_null(self::$connect))
            self::$connect=Connect::getInstance()->getConnexion();
    }


    public static function getAllContacts(int $userid){
        try{
            $query="SELECT * FROM contacts WHERE id_user=?";
            $pst=self::$connect->prepare($query);
            $pst->bindValue(1,$userid,PDO::PARAM_STR);
            $pst->execute();
            $retour=[];
            while($row=$pst->fetch()){
                $contact=new Contact($row["lastname"],$row["firstname"],$row["mail"],$row["phone"],DateTime::createFromFormat('Y-m-d H:i:s',$row["birthdate"]),$row["filepath"],intval($row["id"]));
                array_push($retour,$contact);
            }
            $_SESSION["contacts"]=$retour;
        }
        catch(PDOException $pdoe){
            
        }
    }

    public static function addContact(?string $lastname,?string $firstname,string $mail,?string $phone,?DateTime $birthDate,?string $filepath):?Contact{
        try{
            $query="INSERT INTO contacts(lastname,firstname,mail,phone,birthdate,filepath) VALUES (:lastname,:firstname,:mail,:mail,:birthdate,:filepath) RETURNING id";
            $pst=self::$connect->prepare($query);
            $pst->bindValue("lastname",$lastname,PDO::PARAM_STR);
            $pst->bindValue("firstname",$firstname,PDO::PARAM_STR);
            $pst->bindValue("mail",$mail,PDO::PARAM_STR);
            $pst->bindValue("phone",$phone,PDO::PARAM_STR);
            $pst->bindValue("birthday",$birthDate);
            $pst->bindValue("filepath",$filepath,PDO::PARAM_STR);
            $pst->execute();
            if($row=$pst->fetch()){
                $contact=new Contact($lastname,$firstname,$mail,$phone,$birthDate,$filepath,$row["id"]);
                array_push($_SESSION["contacts"],$contact);
                return $contact;
            }
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===22000)
                return null;
        }
    }
}