<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Se connecter à la base de données
    $mysqli = new mysqli("localhost", "nom_utilisateur", "mot_de_passe", "nom_base_de_donnees");

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
    }

    // Préparer la requête SQL pour vérifier les identifiants de connexion
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$username' AND password = '$password'";

    // Exécuter la requête SQL
    $result = $mysqli->query($sql);

    // Vérifier si un utilisateur correspondant a été trouvé
    if ($result->num_rows > 0) {
        // Connexion réussie, rediriger l'utilisateur vers une page sécurisée
        header("Location: index.html");
        exit; // Assurez-vous de terminer le script après la redirection
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }

    // Fermer la connexion
    $mysqli->close();
}
?>

