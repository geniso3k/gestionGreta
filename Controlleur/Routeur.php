<?php

class Routeur{
    
  
    private static $lesActions = array(
        'defaut' => '../Vue/vue404.html',
        'accueil' => 'ctrlAccueil.php',
        'reservation' => 'ctrlReservation.php',
        'connexion' => 'ctrlUser.php',     
        'enregistrement' => 'ctrlUser.php',        
        'deconnexion' => 'ctrlUser.php',        
        'location' => 'ctrlLocation.php', 
        'allProduits' => 'ctrlAdminProduit.php',
        'allReservations' => 'ctrlAdminReservation.php',
        'allLieu' => 'ctrlAdminLieu.php',
        'allUtilisateurs' => 'ctrlAdminUtilisateur.php');    
    
        

    public static function getControleur($action){
   
        $controleur = self::$lesActions["defaut"];

        //Permet de vérifier que l'action existe et renvoie le nom du contrôleur PHP    
        if (array_key_exists ( $action , self::$lesActions )){
            $controleur = self::$lesActions[$action];
        }

        return $controleur;
    }
}

?>