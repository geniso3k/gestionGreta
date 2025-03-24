<?php
include_once("Data/ConnexionDB.php");
include_once("classes/Reservation.php");
include_once("Model/ModelEquipementDAO.php");

class ModelReservationDAO{

    public static function getAllReservation($id = null, $rendu = 0) {
        try {



            if ($id !== null) {
                $req = ConnexionDB::getInstance()->prepare("SELECT * FROM emprunts WHERE id_user = ? AND rendu = ?");
                $req->execute([$id, $rendu]);
            } else {
                // Si aucun ID n'est fourni, on récupère toutes les réservations
                $req = ConnexionDB::getInstance()->prepare("SELECT * FROM emprunts WHERE rendu = ?");
                $req->execute(array($rendu));
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
                    $ligne['signature']
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

    public static function ajouterLocation(Equipement $e, string $user_id, string $datefin, string $datedebut, string $signature){

        try{
            $req = ConnexionDB::getInstance()->prepare("INSERT INTO emprunts (id_equip, id_user, dateDebut, dateFin, signature) VALUES ( ?, ?, ?, ?, ?)");
            
            $result = $req -> execute(array($e->getCode(), $user_id, $datedebut, $datefin, $signature));
            
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


    public static function reservationExist($idEquip){
        $req = ConnexionDB::getInstance()->prepare("
        SELECT id_emprunt 
        FROM emprunts 
        WHERE id_equip = ? AND rendu = 0
        ");
        $req->execute(array($idEquip));

        return $req->rowCount()>0 ? true : false;

    }

    public static function supprimerReservation($id){
        try{

            $req = ConnexionDB::getInstance()->prepare("UPDATE emprunts SET rendu = 1 WHERE id_emprunt = ?");
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
    public static function envoieMail($email, $idEmprunt, $equip, $dateFin) {



        $to = $email;
        $subject = "Retour de votre réservation Nr: $idEmprunt";

        ob_start();  
        include_once("vue/vueEmail.php");  
        $message = ob_get_clean();  
        

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
        $headers .= "From: si@greta-alsace-sud.com" . "\r\n";
        $headers .= "Reply-To: si@greta-alsace-sud.com" . "\r\n";

        if(mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }
    


}



?>