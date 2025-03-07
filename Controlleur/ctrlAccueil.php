<?php

// Affichage des vues
include "$racine/vue/VueEntete.php";
include_once("$racine/model/ModelEquipementDAO.php");

$resultat = ModelEquipementDAO::getAllEquipement();


include "$racine/vue/VueAccueil.php";
include "$racine/vue/VuePied.php";


?>
