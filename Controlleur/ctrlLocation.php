<?php
include_once("Model/ModelEquipementDAO.php");
include_once("Model/ModelReservationDAO.php");
include_once("Vue/VueEntete.php");
include_once("Model/ModelConnDAO.php");

if(isset($_SESSION['email'])){

    $ida = filter_var($_GET['article'], FILTER_VALIDATE_INT);
    $modele = ModelEquipementDAO::findById($ida);
    if($modele){
    if(!empty($_POST) && isset($_GET['article'])){

 
        
$email = filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL);


$datepicker = filter_var($_POST['datepicker'], FILTER_SANITIZE_SPECIAL_CHARS);


if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['datepicker'])) {
    $datepicker = $_POST['datepicker'];  // Ensure it's a valid date string.
} else {
    $datepicker = null;  // Or handle the invalid case.
}



        $dttime = time();
        $dateaujd = DateTime::createFromFormat("U", $dttime);


        $datepicker = DateTime::createFromFormat('Y-m-d', $_POST['datepicker']);
        if ($datepicker === false || $datepicker->format('Y-m-d') !== $_POST['datepicker']) {
            echo "<div class='alert alert-danger'>La date est invalide !</div>";
            die();
            
        }
       
        if($dateaujd < $datepicker){

            if( isset($_POST['consentement']) && $_POST['consentement'] == "on"){

                if(isset($_FILES['signature']) && $_FILES['signature']['error'] == 0){
                    $fileTmpPath = $_FILES['signature']['tmp_name'];
                    $fileName = $_FILES['signature']['name'];
                    $fileSize = $_FILES['signature']['size'];
                    $fileType = $_FILES['signature']['type'];
                    $uploadDir = './img/signatures/';

                    $newFileName = uniqid('signature_') . '.png';
                    $uploadFilePath = $uploadDir . $newFileName;


                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }


                    if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
                        

                        $location = ModelReservationDAO::ajouterLocation($modele, $_SESSION['user_id'], $_POST['datepicker'], $dateaujd->format("Y-m-d"), $newFileName);
                        if($location){
                              echo '<script>window.location.href = "./?action=accueil&alert=succes";</script>';
	die();
                        }




                    } else {
                        echo "<div class='alert alert-danger'>La signature n'a pas été enregistré correctement.</div>";
                    }







                    
                }else{
                    echo "<div class='alert alert-danger'>La signature n'a pas été enregistré correctement.</div>";
                }

               

            }else{
                echo "<div class='alert alert-danger'>Veuillez cocher la case !</div>";
            }
        }else{
            echo "<div class='alert alert-danger'>La date doit être suppérieur à la date du jour.</div>";
        }
    

    }
}
    include_once("Vue/VueFormulaireLoc.php");

}else{

    echo '<script>window.location.href = "./?action=connexion";</script>';
	die();

}
include_once("Vue/VuePied.php");




?>