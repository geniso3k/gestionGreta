<?php
include_once("Model/ModelReservationDAO.php");
include_once("Model/ModelEquipementDAO.php");
include_once($racine."/Vue/VueEntete.php");
if (!isset($_SESSION['role'])) {
    echo '<script>window.location.href = "./?action=connexion";</script>';
			die();
}
$reservations = ModelReservationDAO::getAllReservation($_SESSION['user_id']);



include_once($racine."/Vue/VueReservation.php");
include_once($racine."/Vue/VuePied.php");


?>