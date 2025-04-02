<?php
include_once("Model/ModelConnDAO.php");
include_once("Model/ModelLieuDAO.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] > 1) {
    include_once("Vue/Vue404.html");
    die();
}

include_once("Vue/VueEntete.php");


$lieux = ModelLieuDAO::getAllLieu();

if(isset($_POST['modifier'])){

    $libelle = isset($_POST['nom']) ? 
    filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS) : die("<div class='alert alert-danger'>Le nom ne peux pas être vide</div>");

    $id = isset($_POST['id']) ? 
    filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) : die("<div class='alert alert-danger'>Une erreur s'est produite.</div>");

    if(ModelLieuDAO::modifierLieu($id,$libelle)){
                echo '<script>window.location.href = "./?action=allLieu&alert=succes";</script>';
	die();
    }

}

if(isset($_GET['supprimer'])){

    $id = isset($_GET['supprimer']) ? 
    filter_input(INPUT_GET, 'supprimer', FILTER_SANITIZE_NUMBER_INT) : die("<div class='alert alert-danger'>Une erreur s'est produite.</div>");
    
    if(ModelLieuDAO::supprimerLieu($id)){
                echo '<script>window.location.href = "./?action=allLieu&alert=succes";</script>';
	die();
    }

}
if(isset($_POST['ajouter'])){


    $libelle = isset($_POST['nom']) ? 
    filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS) : die("<div class='alert alert-danger'>Le nom ne peux pas être vide</div>");
    
    if(ModelLieuDAO::ajouterLieu($libelle)){
                echo '<script>window.location.href = "./?action=allLieu&alert=succes";</script>';
	die();
    }

}






if(isset($_GET['alert']) && $_GET['alert'] == 'succes'){
    echo '<div class="alert alert-success">Votre action a été réalisée sans erreur.</div>';
}

include_once("Vue/privilege/vueAllLieu.php");


include_once("Vue/VuePied.php");

?>