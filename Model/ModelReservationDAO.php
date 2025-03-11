<?php
include_once("Data/ConnexionDB.php");
include_once("classes/Reservation.php");
include_once("Model/ModelEquipementDAO.php");

class ModelReservationDAO{

    public static function getAllReservation($id = null) {
        try {
            // Si un ID est fourni, on filtre les réservations par utilisateur
            if ($id !== null) {
                $req = ConnexionDB::getInstance()->prepare("SELECT * FROM emprunts WHERE id_user = ?");
                $req->execute([$id]);
            } else {
                // Si aucun ID n'est fourni, on récupère toutes les réservations
                $req = ConnexionDB::getInstance()->prepare("SELECT * FROM emprunts");
                $req->execute();
            }
    
            $resultat = [];
            // On récupère toutes les lignes de résultat
            while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
                // On crée un objet Reservation avec les données récupérées
                $unObjet = new Reservation(
                    $ligne['id_emprunt'],
                    $ligne['id_equip'],
                    $ligne['id_user'],
                    $ligne['dateDebut'],
                    $ligne['dateFin'],
                    $ligne['prix'],
                    $ligne['quantite']
                );
                $resultat[] = $unObjet;
            }
            
            return $resultat;
    
        } catch (PDOException $ex) {
            // Gestion des erreurs de la requête
            print "Erreur : ". $ex->getMessage();
            return [];
        }
    }

    public static function getEquipementLibelle($id){

        try{

            $req = ConnexionDB::getInstance()->prepare("SELECT libelle FROM equipement WHERE id = ?");
            $req ->execute(array($id));
            $row = $req->fetch();
            return $row['libelle'];

        }catch(PDOException $ex){
            print "Erreur : ". $ex->getMessage();
            die();
        }

    }

    public static function ajouterLocation(Equipement $e, string $user_id, string $datefin, string $datedebut, int $qtt, float $prix){

        try{
            $req = ConnexionDB::getInstance()->prepare("INSERT INTO emprunts (id_equip, id_user, dateDebut, dateFin, prix, quantite) VALUES (?, ?, ?, ?, ?, ?)");
            if(ModelEquipementDAO::modifierStock($e->getCode(), $qtt)){
            $result = $req -> execute(array($e->getCode(), $user_id, $datedebut, $datefin, $prix, $qtt));
            
                if($result){
                    return true;
                }else{
                    return false;
                }
            
            }else{
                echo "<div class='alert alert-danger'>Le produit n'a pas assez de stock.</div>";
                return false;
            }

        }catch(PDOException $ex){
            print "Erreur : ". $ex->getMessage();
            die();
        }
    }

    public static function getStockID($id){
        $req = ConnexionDB::getInstance()->prepare("SELECT quantite, id_equip AS id FROM emprunts WHERE id_emprunt =?");
        $req -> execute(array($id));
        while($row = $req->fetch(PDO::FETCH_ASSOC)){
            return [$row['id'], $row['quantite']];
        }
    }

    public static function supprimerReservation($id){
        try{

            $req = ConnexionDB::getInstance()->prepare("SELECT stock FROM equipement where id = ?");
            $req->execute(array(SELF::getStockID($id)[0]));
            while($row = $req->fetch(PDO::FETCH_ASSOC)){
                $stock = $row['stock'];
            }
            $stock += SELF::getStockID($id)[1]; 
            ModelEquipementDAO::modifierStock(SELF::getStockID($id)[0], $stock, "notnull");

            $req = ConnexionDB::getInstance()->prepare("DELETE FROM emprunts WHERE id_emprunt = ?");
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

    public static function reservationExiste($id){

        try{

            $req = ConnexionDB::getInstance()->prepare("SELECT * FROM emprunts WHERE id_emprunt = ?");
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

    public static function editDate($dateDebut, $dateFin, $id){

        try{

            $req = ConnexionDB::getInstance()->prepare("UPDATE emprunts SET dateDebut = ?, dateFin= ? WHERE id_emprunt = ?");
            $result = $req ->execute(array($dateDebut,$dateFin,$id));

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