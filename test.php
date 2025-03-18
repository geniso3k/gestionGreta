<?php 

/*
require 'classes/PHPMailer/src/Exception.php';
require 'classes/PHPMailer/src/PHPMailer.php';
require 'classes/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);

try {
    
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;
    $mail->Username = 'si@greta-alsace-sud.com';  
    $mail->Password = 'GretColm68!?';      
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
    $mail->Port = 587; 


    $mail->setFrom('si@greta-alsace-sud.com', 'Nom');
    $mail->addAddress('prishtinalik@hotmail.fr', 'Nom du destinataire'); 


    $mail->Subject = 'Test';
    $mail->Body    = 'Ceci est un test';
    $mail->SMTPDebug = 2;

    if ($mail->send()) {
        echo 'Message envoyé avec succès';
    } else {
        echo 'Erreur lors de l\'envoi du message: ' . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo 'Le message n\'a pas pu être envoyé. Erreur : ', $mail->ErrorInfo;
}
*/


$to = "destinataire@example.com";
$subject = "Test Email";
$message = "Ceci est un test d'envoi d'email.";
$headers = "From: expéditeur@example.com";

if (mail($to, $subject, $message, $headers)) {
    echo "L'email a été envoyé avec succès.";
} else {
    echo "L'envoi de l'email a échoué.<br>";

    // Récupération des erreurs PHP
    $error = error_get_last();
    if ($error) {
        echo "Erreur PHP : " . $error['message'];
    } else {
        echo "Aucune erreur PHP détaillée disponible.";
    }
}

?>