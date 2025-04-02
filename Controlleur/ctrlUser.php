<?php 



    include_once('Data/ConnexionDB.php');
    include_once("Vue/VueEntete.php");
    include_once("Model/ModelConnDAO.php");


    if(isset($_SESSION['email'])){
        if($_GET['action'] == "deconnexion"){
            session_destroy();
            
        }
        echo '<script>window.location.href = "./?action=accueil";</script>';
			die();
    }else{
        if($_GET['action'] == "connexion"){
            

            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, "password"); 
            if(!empty($email) && !empty($password)){

                if(ModelConnDAO::login($email,$password)){

                    echo '<script>window.location.href = "./?action=accueil";</script>';
			die();

                }else{
                    echo 'une erreur s\'est produite !';
                    include_once('Vue/VueConnexion.php');
                }

            }else{
                if(!empty($_POST)){
                    echo'Une erreur s\'est produite';

                }
                include_once("Vue/VueConnexion.php");
            }
        }else if($_GET['action'] == "enregistrement"){


$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL); // Utiliser FILTER_SANITIZE_EMAIL pour l'email
$password = filter_input(INPUT_POST, "password");  // Assurez-vous d'avoir un mot de passe sécurisé
$confirmpassword = filter_input(INPUT_POST, "confirmpassword"); // Correction du nom du champ
$nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS); // Utiliser FILTER_SANITIZE_SPECIAL_CHARS
$prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS); // Utiliser FILTER_SANITIZE_SPECIAL_CHARS

            if(!empty($email) && !empty($password) && !empty($confirmpassword) && !empty($nom) && !empty($prenom)){

                if(ModelConnDAO::register($nom,$prenom,$email,$password,$confirmpassword)){
                    echo 'Enregistrement avec succès, patientez vous allez être redirigé !';

                        echo '<script>window.location.href = "./?action=connexion&alert=succes";</script>';
			die();
                }else{
                    echo 'Une erreur s\'est produite !';
                }

            }else{
                if(!empty($_POST)){
                    echo "Une erreur s'est produite !";
                }
                include_once("Vue/VueEnregistrement.php");
            }
        } 
        
    }
    


    include_once("Vue/VuePied.php");
?>