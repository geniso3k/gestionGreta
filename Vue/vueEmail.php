
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retour d'équipement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #0073e6;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .details {
            background-color: #f9f9f9;
            padding: 15px;
            border: 1px solid #e1e1e1;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>Retour d'équipement</h1>
        <p>Bonjour,</p>
        <p>Nous vous informons que vous devez rendre l'équipement impérativement. Voici les détails de votre retour :</p>

        <div class="details">
            <p><strong>Nom de l'équipement :</strong> <?= $equip ?></p>
            <p><strong>Numéro de l'emprunt :</strong> <?=$idEmprunt?></p>
            <p><strong>Date de retour :</strong> max. <?= $dateFin->format("d/m/Y");  ?></p>
        </div>

        <p>Si vous avez des questions ou des préoccupations concernant ce retour, n'hésitez pas à nous contacter en répondant à ce mail. </p>

        <div class="footer">
            <p>Cordialement,<br>L'équipe de support</p>
        </div>
    </div>
</body>
</html>
