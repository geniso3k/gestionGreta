<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] > 2) {
    include_once("vue/vue404.html");
    die();
}


include_once("vue/VueEntete.php");
include_once("Model/ModelEquipementDAO.php");


$equipement = ModelEquipementDAO::getAllEquipement();
$allCat = ModelCategorieDAO::getAllCategorie();
$allLieu = ModelLieuDAO::getAllLieu();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['ajouter'])) {

        
        $categorieId = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_NUMBER_INT);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
        $lieu = filter_input(INPUT_POST, 'lieu', FILTER_SANITIZE_STRING);
        $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);

        
        $uploadDir = './img/';
        $img = isset($_FILES['image']) ? $_FILES['image'] : null;
        
        if ($img === null) {
            echo '<div class="alert alert-danger">Fichier introuvable.</div>';
            exit;
        }

       
        $fileExtension = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($fileExtension, $allowedExtensions)) {
            echo '<div class="alert alert-danger" role="alert">Extension de fichier non autorisée.</div>';
            exit;
        }

       
        if ($img['size'] > 5 * 1024 * 1024) {
            echo "<div class='alert alert-danger'>Le fichier est trop volumineux. Maximum : 5 Mo.</div>";
            exit;
        }

       
        $fileName = ModelEquipementDAO::recupererAI()['auto_increment'] . '.jpg'; 
        $uploadFile = $uploadDir . $fileName;

        
        if (empty($categorieId) || empty($nom) || empty($desc)) {
            echo '<div class="alert alert-danger" role="alert">Tous les champs sont requis.</div>';
            exit;
        }

        
        if (move_uploaded_file($img['tmp_name'], $uploadFile)) {

           
            $result = ModelEquipementDAO::ajouterProduit($categorieId, $nom, $desc, $lieu);

            
            if ($result) {
                
                header("Location: ./?action=allProduits&alert=succes");
                exit();
            } else {
                echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'ajout du produit. Veuillez réessayer.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Erreur lors du téléchargement du fichier. Veuillez réessayer.</div>';
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
        $lieu = filter_input(INPUT_POST, 'lieu', FILTER_SANITIZE_STRING);

        var_dump($_POST);
        // Validation des données
        if (empty($id) || empty($nom) || empty($desc) ||empty($lieu)) {
            echo '<div class="alert alert-danger" role="alert">Tous les champs sont requis.</div>';
        } else {



            $result = ModelEquipementDAO::modifierAll($id, $nom, $desc, $lieu);

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