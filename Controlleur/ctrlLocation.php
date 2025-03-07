<?php
include_once("Model/ModelEquipementDAO.php");
include_once("Model/ModelReservationDAO.php");
include_once("vue/vueEntete.php");
if(isset($_SESSION['email'])){

    $ida = filter_var($_GET['article'], FILTER_VALIDATE_INT);
    $modele = ModelEquipementDAO::findById($ida);
    if($modele){
    if(!empty($_POST) && isset($_GET['article'])){

 
        
        $email = filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL);
        $qtt = filter_var($_POST['qtt'], FILTER_VALIDATE_INT);
        $datepicker = filter_var($_POST['datepicker'], FILTER_SANITIZE_STRING); 



        $dttime = time();
        $dateaujd = date("Y-m-d", $dttime);

        $datepicker = DateTime::createFromFormat('Y-m-d', $_POST['datepicker']);
        if ($datepicker === false || $datepicker->format('Y-m-d') !== $_POST['datepicker']) {
            echo "<div class='alert alert-danger'>La date est invalide !</div>";
            die();
            
        }
        
        if($dateaujd < $datepicker){

            if( isset($_POST['consentement']) && $_POST['consentement'] == "on"){

                if(isset($_POST['qtt']) && $_POST['qtt'] > 0){


                    $location = ModelReservationDAO::ajouterLocation($modele, $_SESSION['user_id'], $_POST['datepicker'], $dateaujd,$_POST['qtt'], $_POST['prix']);
                    if($location){
                        header("Location: ./?action=accueil&alert=succes");
                        die();
                    }


                }else{

                    echo "<div class='alert alert-danger'>La quantité est incorrecte !</div>";

                }

            }else{
                echo "<div class='alert alert-danger'>Veuillez cocher la case !</div>";
            }
        }else{
            echo "<div class='alert alert-danger'>La date doit être suppérieur à la date du jour.</div>";
        }
    

    }
}
    include_once("vue/vueFormulaireLoc.php");

}else{

    header("Location: ./?action=connexion");

}
include_once("vue/vuePied.php");




?>