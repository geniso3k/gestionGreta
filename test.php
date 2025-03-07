<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Remplacez par votre utilisateur DB
$password = ""; // Remplacez par votre mot de passe DB
$dbname = "gretageniss"; // Nom de la base de données

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Nombre d'utilisateurs à générer (entre 50 et 100)
$num_users = rand(50, 100);

// Préparer une requête SQL pour insérer un utilisateur
$stmt = $conn->prepare("INSERT INTO utilisateur (nom, prenom, email, password, role) VALUES (?, ?, ?, ?, ?)");

// Vérifier si la préparation de la requête est réussie
if ($stmt === false) {
    die("Erreur de préparation de la requête: " . $conn->error);
}

// Générer les utilisateurs
for ($i = 1; $i <= $num_users; $i++) {
    // Générer des données aléatoires pour chaque utilisateur
    $nom = "Nom" . $i;
    $prenom = "Prenom" . $i;
    $email = "utilisateur" . $i . "@exemple.com";
    $password = password_hash("password" . $i, PASSWORD_BCRYPT); // Générer un mot de passe sécurisé
    $role = 3;

    // Lier les paramètres à la requête préparée
    $stmt->bind_param("ssssi", $nom, $prenom, $email, $password, $role);

    // Exécuter la requête
    if (!$stmt->execute()) {
        echo "Erreur lors de l'insertion de l'utilisateur $i: " . $stmt->error . "<br>";
    }
}

echo "$num_users utilisateurs générés avec succès !";

// Fermer la connexion
$stmt->close();
$conn->close();
?>
