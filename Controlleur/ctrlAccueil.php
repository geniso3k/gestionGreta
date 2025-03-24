<?php

// Affichage des vues
include "$racine/vue/VueEntete.php";
include_once("$racine/model/ModelEquipementDAO.php");
include_once("$racine/model/ModelReservationDAO.php");
include_once("$racine/model/ModelCategorieDAO.php");
include_once("$racine/model/ModelLieuDAO.php");


$categorie = isset($_GET['idCat']) ? filter_input(INPUT_GET, 'idCat', FILTER_SANITIZE_STRING) : null;

$lieu = isset($_GET['idLieu']) ? filter_input(INPUT_GET, 'idLieu', FILTER_SANITIZE_STRING) : null;
$allCat = ModelCategorieDAO::getAllCategorie();
$allLieu = ModelLieuDAO::getAllLieu();


include "$racine/vue/VueAccueil.php";
include "$racine/vue/VuePied.php";


?>
