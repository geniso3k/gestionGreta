<?php

class Routeur{
    
    //Attributs
    private static $lesActions = array(
        'defaut' => '../Vue/vue404.html',
        'accueil' => 'CtrlAccueil.php',
        'reservation' => 'CtrlReservation.php',
        'connexion' => 'CtrlUser.php',     
        'enregistrement' => 'CtrlUser.php',        
        'deconnexion' => 'ctrlUser.php',        
        'location' => 'ctrlLocation.php', 
        'allProduits' => 'ctrlAdminProduit.php',
        'allReservations' => 'ctrlAdminReservation.php',
        'allUtilisateurs' => 'ctrlAdminUtilisateur.php');    
    
        
    //Fonction qui retourne le fichier controleur à utiliser
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