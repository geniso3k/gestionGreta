<?php
include_once("Data/ConnexionDB.php");
include_once("classes/Categorie.php");

class ModelCategorieDAO{
    private int $id;
    private string $libelle;

    public static function getCategorie($id){

        $req = ConnexionDB::getInstance()->prepare("SELECT libelle FROM categorie WHERE id = ?");
        $req -> execute(array($id));
        $row = $req->fetch(PDO::FETCH_ASSOC);
        return $row['libelle'];   

    }
    public static function existCategorie($id){
        $req = ConnexionDB::getInstance()->prepare("SELECT libelle FROM categorie WHERE id = ?");
        $req -> execute(array($id));
        return ($req->rowCount()>0);

    }

    public static function getAllCategorie(){


        $req = ConnexionDB::getInstance() -> query("SELECT * FROM categorie");
        while($row = $req->fetch(PDO::FETCH_ASSOC)){

            $unObjet = new Categorie($row['id'], $row['libelle']);
            $result[] = $unObjet;

        }

        return $result;

    }
}

?>