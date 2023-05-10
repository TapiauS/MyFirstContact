<?php
class ContactManager{
    private static ?PDO $connect=null;

    public static function init(){
        if(is_null(self::$connect))
            self::$connect=Connect::getInstance()->getConnexion();
    }


    public static function getAllContacts(int $userid){
        try{
            $query="SELECT * FROM contacts WHERE id_user=?";
            self::init();
            $pst=self::$connect->prepare($query);
            $pst->bindValue(1,$userid,PDO::PARAM_STR);
            $pst->execute();
            $retour=[];
            while($row=$pst->fetch()){
                if(!is_null($row["birthdate"]))
                    $contact=new Contact($row["lastname"],$row["firstname"],$row["email"],$row["phone"],DateTime::createFromFormat('Y-m-d',$row["birthdate"]),$row["picture_path"],intval($row["id"]));
                else
                    $contact=new Contact($row["lastname"],$row["firstname"],$row["email"],$row["phone"],null,$row["picture_path"],intval($row["id"]));
                array_push($retour,$contact);
            }
            $_SESSION["contacts"]=$retour;
        }
        catch(PDOException $pdoe){
            
        }
    }

    public static function addContact(?string $lastname,?string $firstname,string $mail,?string $phone,?DateTime $birthDate,?string $filepath):?Contact{
        try{
            self::init();
            $query="INSERT INTO contacts(lastname,firstname,email,phone,birthdate,picture_path,id_user) VALUES (:lastname,:firstname,:mail,:phone,:birthday,:filepath,:iduser) RETURNING id";
            $pst=self::$connect->prepare($query);
            $pst->bindValue("lastname",$lastname,PDO::PARAM_STR);
            $pst->bindValue("firstname",$firstname,PDO::PARAM_STR);
            $pst->bindValue("mail",$mail,PDO::PARAM_STR);
            $pst->bindValue("phone",$phone,PDO::PARAM_STR);
            if(!is_null($birthDate))
                $pst->bindValue("birthday",$birthDate->format('y-m-d'),PDO::PARAM_STR);
            else
                $pst->bindValue("birthday",null);
            $pst->bindValue("filepath",$filepath,PDO::PARAM_STR);
            $user=$_SESSION["user"];
            var_dump($user);
            $pst->bindValue("iduser",$user->getId());
            $pst->execute();
            if($row=$pst->fetch()){
                $contact=new Contact($lastname,$firstname,$mail,$phone,$birthDate,$filepath,$row["id"]);
                array_push($_SESSION["contacts"],$contact);
                return $contact;
            }
            else
                return null;
        }
        catch(PDOException $pdoe){
            var_dump($pdoe);
            if($pdoe->getCode()===22000):
                var_dump($pdoe);
            endif;
            return null;
        }
    }

    public static function removeContact(?Contact $contact){
        try{
            self::init();
            $query="DELETE FROM contacts WHERE id=:id";
            $pst=self::$connect->prepare($query);
            $pst->bindValue('id',$contact->getId());
            $pst->execute();
        }
        catch(PDOException $pdoe){

        }
    }

    public static function updateContact(?string $lastname,?string $firstname,string $mail,?string $phone,?DateTime $birthDate,?string $filepath,int $id){
        self::init();
        $query="UPDATE contacts SET lastname=:lastname,firstname=:firstname,email=:mail,phone=:phone,birthdate=:birthday,picture_path=:filepath,id_user=:iduser WHERE id=:id";
        $pst=self::$connect->prepare($query);
        $pst->bindValue("lastname",$lastname,PDO::PARAM_STR);
        $pst->bindValue("firstname",$firstname,PDO::PARAM_STR);
        $pst->bindValue("mail",$mail,PDO::PARAM_STR);
        $pst->bindValue("phone",$phone,PDO::PARAM_STR);
        if(!is_null($birthDate))
            $pst->bindValue("birthday",$birthDate->format('y-m-d'),PDO::PARAM_STR);
        else
            $pst->bindValue("birthday",null);
        $pst->bindValue("filepath",$filepath,PDO::PARAM_STR);
        $user=$_SESSION["user"];
        $pst->bindValue("iduser",$user->getId());
        $pst->bindValue("id",$id);
        $pst->execute();
    }
}