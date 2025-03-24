<?php

// Affichage des vues
include "$racine/vue/VueEntete.php";
include_once("$racine/model/ModelEquipementDAO.php");
include_once("$racine/model/ModelReservationDAO.php");
include_once("$racine/model/ModelCategorieDAO.php");

if(isset($_GET['idCat'])){
    $categorie = filter_input(INPUT_GET, 'categorie', FILTER_SANITIZE_STRING);
}
$allCat = ModelCategorieDAO::getAllCategorie();


include "$racine/vue/VueAccueil.php";
include "$racine/vue/VuePied.php";


?>
