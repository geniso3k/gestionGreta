<?php 



    include_once('Data/connexionDB.php');
    include_once("Vue/vueEntete.php");
    include_once("Model/ModelConnDAO.php");


    if(isset($_SESSION['email'])){
        if($_GET['action'] == "deconnexion"){
            session_destroy();
            
        }
        header("Location: ./?action=accueil");
    }else{
        if($_GET['action'] == "connexion"){
            

            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, "password"); 
            if(!empty($email) && !empty($password)){

                if(ModelConnDAO::login($email,$password)){

                    header("Location: ./?action=accueil");
                    die();

                }else{
                    echo 'une erreur s\'est produite !';
                    include_once('Vue/vueConnexion.php');
                }

            }else{
                if(!empty($_POST)){
                    echo'Une erreur s\'est produite';

                }
                include_once("Vue/vueConnexion.php");
            }
        }else if($_GET['action'] == "enregistrement"){


            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, "password"); 
            $confirmpassword = filter_input(INPUT_POST, "password"); 
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_STRING);
            if(!empty($email) && !empty($password) && !empty($confirmpassword) && !empty($nom) && !empty($prenom)){

                if(ModelConnDAO::register($nom,$prenom,$email,$password,$confirmpassword)){
                    echo 'Enregistrement avec succès, patientez vous allez être redirigé !';
                    header("Location: ./?action=connexion&alert=succes");
                    die();
                }else{
                    echo 'Une erreur s\'est produite !';
                }

            }else{
                if(!empty($_POST)){
                    echo "Une erreur s'est produite !";
                }
                include_once("Vue/vueEnregistrement.php");
            }
        } 
        
    }
    


    include_once("Vue/vuePied.php");
?>