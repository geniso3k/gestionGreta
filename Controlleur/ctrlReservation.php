<?php
include_once("Model/ModelReservationDAO.php");
include_once("Model/ModelEquipementDAO.php");
include_once($racine."/vue/vueEntete.php");
if (!isset($_SESSION['role'])) {
    header("Location: ./?action=connexion");
    die();
}
$reservations = ModelReservationDAO::getAllReservation($_SESSION['user_id']);



include_once($racine."/vue/vueReservation.php");
include_once($racine."/vue/vuePied.php");


?>