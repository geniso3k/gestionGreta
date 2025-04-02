<?php

if (!isset($_SESSION['role']) || $_SESSION['role'] > 2) {
    include_once("Vue/Vue404.html");
    die();
}


include_once("Vue/VueEntete.php");
include_once("Model/ModelReservationDAO.php");
include_once("Model/ModelConnDAO.php");



$reservlink = isset($_GET['reservation']) ? $_GET['reservation'] : "encours";
$rendu = isset($_GET['reservation']) ? 1 : 0;




$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;


$perPage = 10;

// Calculer l'offset
$start = ($page - 1) * $perPage;

// systeme de pagination :::::::    $users = ModelReservationDAO::getReservation($start, $perPage);


$retour = (isset($_GET['retour']) && is_numeric($_GET['retour'])) ? filter_var($_GET['retour'], FILTER_SANITIZE_NUMBER_INT) : null;





$reservations =  isset($retour) ? ModelReservationDAO::getAllReservation(null, $rendu, $retour) : ModelReservationDAO::getAllReservation(null, $rendu);


if(isset($_GET['supprimer'])){

    if(is_numeric($_GET['supprimer'])){

        if(ModelReservationDAO::reservationExist($_GET['supprimer'])){

            if(ModelReservationDAO::supprimerReservation($_GET['supprimer'])){


echo '<script>window.location.href = "./?action=allReservations&alert=succes";</script>';
	die();

            }


        }else{
            echo '<div class="alert alert-danger" role="alert">La réservation n\'a pas été trouvée.</div>';  
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
    $start = filter_var($_POST['start'], FILTER_SANITIZE_SPECIAL_CHARS);
    $end = filter_var($_POST['end'], FILTER_SANITIZE_SPECIAL_CHARS);

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
                 echo '<script>window.location.href = "./?action=allReservations&alert=succes";</script>';
	die();
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

include_once("Vue/privilege/vueAllReservations.php");
include_once("Vue/VuePied.php");

?>