<?php

include_once("./Data/ConnexionDB.php");
include_once("./classes/Equipement.php");
include_once("./Model/ModelCategorieDAO.php");

class ModelEquipementDAO {

    public static function getAllEquipement(){
        try{

            $req = ConnexionDB::getInstance()->query("SELECT * FROM equipement ");
            $req->execute();

             //plusieurs lignes de résultat
             while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {

               
                $unObjet = new Equipement($ligne['id'], $ligne['libelle'], $ligne['prix'], $ligne['stock'], ModelCategorieDAO::getCategorie($ligne['catégorie']));
                $resultat[] = $unObjet;
            }     
            return $resultat;      


        }catch(PDOException $ex){
            print "Erreur : ". $ex->getMessage();
        }
    }
    public static function findById($code){
        try {
            $req = ConnexionDB::getInstance()->prepare("SELECT * FROM equipement WHERE id = :code");
            $req->bindValue(':code', $code, PDO::PARAM_STR);
            $req->execute();

            //une seule ligne de résultat traitée comme s'il y en avait plusieurs (pour harmoniser la vue résultat)
            while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
                $unEquipement = new Equipement($ligne['id'], $ligne['libelle'], $ligne['prix'], $ligne['stock']);
            }            
            return $unEquipement;

        }
        catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    

    public static function modifierStock($id, $qtt){

        try{
            $req = ConnexionDB::getInstance()->prepare("SELECT stock FROM equipement WHERE id = ?");
            $req -> execute(array($id));
            $row = $req->fetch(PDO::FETCH_ASSOC);
            $stock = $row['stock'];

            $resultat = $stock - $qtt;
            if($resultat < 0){
                return false;
            }

            $req = ConnexionDB::getInstance()->prepare("UPDATE equipement SET stock = ? WHERE id = ?");
            $result = $req -> execute(array($resultat, $id));

            if($result){
                return true;
            }else{
                return false;
            }

        }catch(PDOException $ex){
            print "Erreur : ". $ex->getMessage();
            die();
        }
    }

    public static function modifierAll($id, string $nom,$prix,$stock){

        try{

            
            $req = ConnexionDB::getInstance() ->prepare("UPDATE equipement SET libelle = ?, prix = ?, stock = ? WHERE id = ?");
            $result = $req -> execute(array($nom,$prix,$stock,$id));

            if($result){
                return true;
            }else{
                return false;
            }

        }catch(PDOException $ex){
            print "Erreur : ". $ex->getMessage();
            die();
        }


    }

    public static function ajouterProduit($categorie, $nom, $prix, $stock){

        try{
            $req = ConnexionDB::getInstance()->prepare("INSERT INTO equipement (catégorie, libelle, prix, stock) VALUES (?,?,?,?)");
            $result = $req -> execute(array($categorie, $nom, $prix, $stock));

            if($result){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $ex){
            print "Erreur : ". $ex->getMessage();
            die();
        }

    }

    public static function supprimerProduit($id){
        try{

            $req = ConnexionDB::getInstance()->prepare("DELETE FROM equipement WHERE id = ?");
            $result = $req ->execute(array($id));

            if($result){
                return true;
            }else{
                return false;
            }

        }catch(PDOException $ex){
            print ("erreur : ".$ex->getMessage());
            die();
        }



    }


}
?>