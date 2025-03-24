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

    public static function modifierLieu($id, $libelle){

        $req = ConnexionDB::getInstance() -> prepare("UPDATE localisation SET libelle = ? WHERE id = ?");
        
        $result = $req -> execute(array($libelle,$id));
        
        return $result ? true: false;

    }

    public static function supprimerLieu($id){
    
        try{

            $req = ConnexionDB::getInstance() -> prepare("DELETE FROM localisation WHERE id = ?");
            $req -> execute(array($id));
            return $req ? true:false;

        }catch(PDOException $ex){
            print ("erreur : ".$ex->getMessage());
            die();
        }
    }

    public static function ajouterLieu($libelle){
        try{

            $req = ConnexionDB::getInstance() -> prepare("INSERT INTO localisation (libelle) VALUES (?)");
            $req -> execute(array($libelle));
            return $req ? true:false;

        }catch(PDOException $ex){
            print ("erreur : ".$ex->getMessage());
            die();
        }
    }
}

?>