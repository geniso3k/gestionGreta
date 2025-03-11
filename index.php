<?php
    //Permet de connaitre la racine du projet
    $racine = dirname(__FILE__);
    session_start();

    //inclure le routeur
    include "$racine/Controlleur/Routeur.php";

    //Récupération de l'action à exécuter dans l'URL en méthode GET
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if (!isset($action)){
        $action = "accueil";
    }

    //Appel au routeur pour récupérer le controleur à appeler
    $controleur = Routeur::getControleur($action);

    //Inclure le bon controleur
    include "$racine/Controlleur/$controleur";
    ?>