<?php

include_once("./Data/ConnexionDB.php");
include_once("./classes/Equipement.php");
include_once("./Model/ModelCategorieDAO.php");
include_once("./Model/ModelLieuDAO.php");

class ModelEquipementDAO {

    public static function getAllEquipement($cat = null, $lieu = null){
        try{
            if((isset($cat) && isset($lieu)) || isset($cat) ||isset($lieu)){

                if($cat != null && $lieu == null){
                    if(ModelCategorieDAO::existCategorie($cat)){

                        $sql = "SELECT * FROM equipement WHERE catégorie = ? ORDER BY catégorie,lieu";
                        $param = array($cat);

                    }else{
                        echo '<script>window.location.href="./?action=accueil"</script>';
                        die();
                    }
                }else if($cat == null && $lieu != null){
                    if(ModelLieuDAO::existLieu($lieu)){

                        $sql = "SELECT * FROM equipement WHERE lieu = ? ORDER BY catégorie,lieu";
                        $param = array($lieu);

                    }else{
                        echo '<script>window.location.href="./?action=accueil"</script>';
                        die();
                    }
                }else{
                    if(ModelCategorieDAO::existCategorie($cat) && ModelLieuDAO::existLieu($lieu)){

                        $sql = "SELECT * FROM equipement WHERE catégorie = ? AND lieu = ? ORDER BY catégorie,lieu";
                        $param = array($cat,$lieu);

                    }else{
                        echo '<script>window.location.href="./?action=accueil"</script>';
                        
                    }
                }





                    

                    $req = ConnexionDB::getInstance()->prepare($sql);
                    $req ->execute($param);

                    if($req->rowCount() <1){

                        return [];
                    }

                

                    
                

            }else{

                $req = ConnexionDB::getInstance()->query("SELECT * FROM equipement ORDER BY catégorie,lieu");
            }
            

             //plusieurs lignes de résultat
             while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {

               
                $unObjet = new Equipement(
                    $ligne['id'],
                    $ligne['libelle'], 
                    ModelCategorieDAO::getCategorie($ligne['catégorie']), 
                    $ligne['description'],
                    $ligne['lieu']
            );

                $resultat[] = $unObjet;
            }     
            
                return $resultat; 
               


        }catch(PDOException $ex){
            print "Erreur : ". $ex->getMessage();
        }
    }
    public static function recupererAI(){

        $sql = "
        SELECT auto_increment 
        FROM information_schema.tables 
        WHERE table_name = 'equipement' AND table_schema = DATABASE();
        ";
    
        try {
            $req = ConnexionDB::getInstance()->query($sql);
            return $req->fetch();
        } catch (Exception $e) {
            
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }
    
    public static function findById($code){
        try {
            $req = ConnexionDB::getInstance()->prepare("SELECT * FROM equipement WHERE id = :code");
            $req->bindValue(':code', $code, PDO::PARAM_STR);
            $req->execute();

            //une seule ligne de résultat traitée comme s'il y en avait plusieurs (pour harmoniser la vue résultat)
            while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
                $unEquipement = new Equipement($ligne['id'], $ligne['libelle'],  null, $ligne['description'], $ligne['lieu']);
            }            
            return $unEquipement;

        }
        catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    

    

    public static function modifierAll($id, string $nom, $desc, $lieu){

        try{

            
            $req = ConnexionDB::getInstance() ->prepare("UPDATE equipement SET libelle = ?,  description = ?, lieu = ? WHERE id = ?");
            $result = $req -> execute(array($nom,$desc,$lieu,$id));

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

    public static function ajouterProduit($categorie, $nom, $desc, $lieu){

        try{
            $req = ConnexionDB::getInstance()->prepare("INSERT INTO equipement (catégorie, libelle,  description, lieu) VALUES (?,?,?, ?)");
            $result = $req -> execute(array($categorie, $nom,  $desc, $lieu));

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
            $chemin = "./img/".$id.".jpg";
 

            if($result){
                return unlink($chemin) ? true:false;
            }else{
                return false;
            }

        }catch(PDOException $ex){
            print ("erreur : ".$ex->getMessage());
            die();
        }

    }

    public static function getDescription($id){
        $req = ConnexionDB::getInstance()->prepare("SELECT description FROM equipement WHERE id = ?");
        $req -> execute(array($id));
        while($row = $req->fetch()){
            return $row['description'];
        }

    }

    public static function rechercher( string $motcle){
        try{
            sleep(0.5);
            $motcle = "%".$motcle."%";
            $req = ConnexionDB::getInstance()->prepare("SELECT * FROM `equipement` WHERE `libelle` LIKE ?");
            $req -> execute(array($motcle));
            $objets = [];
            while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {

                
                    $unObjet = new Equipement(
                        $ligne['id'],
                        $ligne['libelle'], 
                        ModelCategorieDAO::getCategorie($ligne['catégorie']), 
                        $ligne['description'],
                        $ligne['lieu']
                );

                $objets[] = $unObjet;
            }

            return $objets;

        }catch(PDOException $ex){
            echo 'Erreur : '. $ex->getMessage(); die();
        }
    }


}
?>