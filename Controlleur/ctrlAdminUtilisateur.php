<?php


if (!isset($_SESSION['role']) || $_SESSION['role'] > 1) {
    include_once("vue/vue404.html");
    die();
}

include_once("Model/ModelConnDAO.php");


$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;


$perPage = 10;

// Calculer l'offset
$start = ($page - 1) * $perPage;


$users = ModelConnDAO::getUsers($start, $perPage);


$totalUsers = ModelConnDAO::getTotalUsers();

// Calculer le nombre total de pages
$totalPages = ceil($totalUsers / $perPage);


$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; 



include_once("vue/vueEntete.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['majRole'])) {
        if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
            $userId = $_POST['user_id'];

            if (isset($_POST['role']) && in_array($_POST['role'], [1, 2, 3])) {
                $role = $_POST['role'];


                if (ModelConnDAO::exist($_POST['email_id'])) {
                    
                    if(ModelConnDAO::updateRole($_POST['role'], $_POST['user_id'])){

                        header("Location: ./?action=allUtilisateurs&alert=succes"); 
                        exit();
                    }else{
                        echo '<div class="alert alert-danger" role="alert">Une erreur s\'est produite.</div>'; 
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">Utilisateur non trouvé.</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Rôle invalide.</div';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">ID utilisateur invalide.</div>';
        }
    }
}

if($_SERVER['REQUEST_METHOD'] === 'GET'){

    if(isset($_GET['id']) && isset($_GET['email'])){

        if(is_numeric($_GET['id'])){

            if(ModelConnDAO::exist($_GET['email'])){

                if(ModelConnDAO::supprimerUser($_GET['id'])){

                    header("Location: ./?action=allUtilisateurs&alert=succes"); 
                        exit();

                }

            }else{

                echo '<div class="alert alert-danger" role="alert">Utilisateur introuvable.</div>';

            }

        }else{
            echo '<div class="alert alert-danger" role="alert">ID utilisateur invalide.</div>';
        }

    }

}







if(isset($_GET['alert']) && $_GET['alert'] == 'succes'){
    echo '<div class="alert alert-success" role="alert">Action réalisée avec succès.</div>';
}

include_once("vue/privilege/vueAllUsers.php");
include_once("vue/vuePied.php");

?>