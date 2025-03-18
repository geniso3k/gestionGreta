<?php

// Affichage des vues
include "$racine/vue/VueEntete.php";
include_once("$racine/model/ModelEquipementDAO.php");
include_once("$racine/model/ModelReservationDAO.php");

$allobj = ModelEquipementDAO::getAllEquipement();



foreach($allobj as $result){

    if(!ModelReservationDAO::reservationExist($result->getCode()))
    {
        $resultat[] = $result;
    }


}


include "$racine/vue/VueAccueil.php";
include "$racine/vue/VuePied.php";


?>
