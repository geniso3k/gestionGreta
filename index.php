<?php

session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);



    $racine = dirname(__FILE__);

    //inclure le routeur
    include_once "$racine/Controlleur/Routeur.php";
    include_once "$racine/Model/ModelConnDAO.php";


// Récupération de l'action à exécuter dans l'URL en méthode GET
$action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : "accueil";

//Appel au routeur pour récupérer le controleur à appeler
    $controleur = Routeur::getControleur($action);

    //Inclure le bon controleur
    include_once "$racine/Controlleur/$controleur";
?>