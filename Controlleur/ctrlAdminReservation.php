<?php

if (!isset($_SESSION['role']) || $_SESSION['role'] > 2) {
    include_once("vue/vue404.html");
    die();
}


include_once("vue/vueEntete.php");
include_once("Model/ModelReservationDAO.php");
include_once("Model/ModelConnDAO.php");

if(!isset($_GET['reservation'])){
    $reservlink = 'encours';
}else{
    $reservlink = $_GET['reservation'];
}


$reservations = ModelReservationDAO::getAllReservation();
if(isset($_GET['supprimer'])){

    if(is_numeric($_GET['supprimer'])){

        if(ModelReservationDAO::reservationExiste($_GET['supprimer'])){

            if(ModelReservationDAO::supprimerReservation($_GET['supprimer'])){

                header("Location: ./?action=allReservations&alert=succes");
                die();

            }


        }

    }else{
        echo '<div class="alert alert-danger" role="alert">Erreur lors de la suppression du produit. Veuillez réessayer.</div>';
    }
}

function validateDates($start, $end) {
    $startDate = DateTime::createFromFormat('Y-m-d', $start);
    $endDate = DateTime::createFromFormat('Y-m-d', $end);

    // Vérifie si les dates sont valides
    if (!$startDate || !$endDate) {
        return false;  // Les dates ne sont pas valides
    }

    // Vérifie si la date de fin est après la date de début
    if ($startDate >= $endDate) {
        return false;
    }

    return true;
}

// Vérifiez si la requête a bien été envoyée via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    // Récupération des données du formulaire
    $idEmprunt = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $start = filter_var($_POST['start'], FILTER_SANITIZE_STRING);
    $end = filter_var($_POST['end'], FILTER_SANITIZE_STRING);

    // Validation des dates
    if (!validateDates($start, $end)) {
        echo '<div class="alert alert-danger" role="alert">Les dates sont invalides. Assurez-vous que la date de début est avant la date de fin.</div>';
        exit;
    }

    // Appel de la fonction pour mettre à jour la réservation
    try {
        $success = ModelReservationDAO::editDate($start, $end, $idEmprunt);

        if ($success) {
            // Rediriger vers la liste des réservations ou afficher un message de succès
            header("Location: ./?action=allReservations&alert=succes");
            exit;
        } else {
            echo '<div class="alert alert-danger" role="alert">Erreur lors de la mise à jour de la réservation.</div>';
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue: " . $e->getMessage();
    }
}

if(isset($_GET['alert']) && $_GET['alert'] == 'succes'){
    echo '<div class="alert alert-success">Votre action a été réalisée sans erreur.</div>';
}

include_once("vue/privilege/vueAllReservations.php");
include_once("vue/vuePied.php");

?>