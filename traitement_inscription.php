<?php
// Connexion à la base de données
require_once "config.php";


// Récupérer les données du formulaire
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hasher le mot de passe
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Préparer et exécuter la requête SQL
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Inscription réussie";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

// Redirection vers la page index.html après l'inscription réussie/ Assurez-vous d'arrêter l'exécution du script après la redirection

// Fermer la connexion
$conn->close();

header("Location: index.html");
exit(); 
?>

!
