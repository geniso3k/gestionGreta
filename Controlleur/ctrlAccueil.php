<?php

// Affichage des vues
include "$racine/Vue/VueEntete.php";
include_once("$racine/Model/ModelEquipementDAO.php");
include_once("$racine/Model/ModelReservationDAO.php");
include_once("$racine/Model/ModelCategorieDAO.php");
include_once("$racine/Model/ModelLieuDAO.php");

$categorie = isset($_GET['idCat']) ? filter_input(INPUT_GET, 'idCat', FILTER_DEFAULT) : '*';
$lieu = isset($_GET['idLieu']) ? filter_input(INPUT_GET, 'idLieu', FILTER_DEFAULT) : '*';
$allCat = ModelCategorieDAO::getAllCategorie();
$allLieu = ModelLieuDAO::getAllLieu();

$allobj = isset($_POST['search']) ? ModelEquipementDAO::rechercher(filter_input(INPUT_POST, 'search', FILTER_DEFAULT)) : null;


include "$racine/Vue/VueAccueil.php";
include "$racine/Vue/VuePied.php";


?>
