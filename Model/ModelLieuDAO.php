<?php
include_once("Data/ConnexionDB.php");
include_once("classes/Lieu.php");

class ModelLieuDAO{
    private int $id;
    private string $libelle;

    public static function getLieu($id){

        $req = ConnexionDB::getInstance()->prepare("SELECT libelle FROM localisation WHERE id = ?");
        $req -> execute(array($id));
        $row = $req->fetch(PDO::FETCH_ASSOC);
        return $row['libelle'];   

    }
    public static function existLieu($id){
        $req = ConnexionDB::getInstance()->prepare("SELECT libelle FROM localisation WHERE id = ?");
        $req -> execute(array($id));
        return ($req->rowCount()>0);

    }

    public static function getAllLieu(){


        $req = ConnexionDB::getInstance() -> query("SELECT * FROM localisation");
        while($row = $req->fetch(PDO::FETCH_ASSOC)){

            $unObjet = new Lieu($row['id'], $row['libelle']);
            $result[] = $unObjet;

        }

        return $result;

    }
}

?>