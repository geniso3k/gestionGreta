<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] > 2) {
    include_once("vue/vue404.html");
    die();
}


include_once("vue/VueEntete.php");
include_once("Model/ModelEquipementDAO.php");


$equipement = ModelEquipementDAO::getAllEquipement();
$allCat = ModelCategorieDAO::getAllCategorie();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['ajouter'])) {

        $categorieId = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_NUMBER_INT);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
        $prix = filter_input(INPUT_POST, 'prix', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT);
        $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);

  
        if (empty($categorieId) || empty($nom)  || empty($desc)) {
            echo '<div class="alert alert-danger" role="alert">Tous les champs sont requis.</div>';
        
        } else {


            $result = ModelEquipementDAO::ajouterProduit($categorieId, $nom, $desc);

            // Vérifier si l'ajout a réussi
            if ($result) {
                // Si l'ajout est réussi, on peut rediriger vers la page des produits (ou afficher un message)
                header("Location: ./?action=allProduits&alert=succes");
                exit();
            } else {
                // Si l'ajout échoue, afficher un message d'erreur
                echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'ajout du produit. Veuillez réessayer.</div>';
            }
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification si le formulaire de modification est soumis
    if (isset($_POST['modifier'])) {
        // Récupérer et filtrer les données du formulaire
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
        $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);

        var_dump($_POST);
        // Validation des données
        if (empty($id) || empty($nom) || empty($desc)) {
            echo '<div class="alert alert-danger" role="alert">Tous les champs sont requis.</div>';
        } else {



            $result = ModelEquipementDAO::modifierAll($id, $nom, $desc);

            // Vérifier si la modification a réussi
            if ($result) {

                header("Location: ./?action=allProduits&alert=succes");
                die();
            } else {
                echo '<div class="alert alert-danger" role="alert">Erreur lors de la modification du produit. Veuillez réessayer.</div>';
            }
        }
    }
}


if(isset($_GET['supprimer'])){

    if(is_numeric($_GET['supprimer'])){

        if(ModelEquipementDAO::findById($_GET['supprimer'])){

            if(ModelEquipementDAO::supprimerProduit($_GET['supprimer'])){

                header("Location: ./?action=allProduits&alert=succes");
                die();

            }


        }

    }else{
        echo '<div class="alert alert-danger" role="alert">Erreur lors de la suppression du produit. Veuillez réessayer.</div>';
    }
}






if(isset($_GET['alert']) && $_GET['alert'] == 'succes'){
    echo '<div class="alert alert-success">Votre action a été réalisée sans erreur.</div>';
}

include_once("vue/privilege/VueAllProduits.php");
include_once("vue/VuePied.php");




?>