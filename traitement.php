<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialiser le score
    $score = 0;

    // Vérifier et traiter chaque réponse
    if ($_POST['question1'] == 'a') {
        $score++;
    }

    // Ajouter des conditions similaires pour les autres questions

    // Afficher le score
    echo "Votre score est de : " . $score . " / 15";
} else {
    // Redirectionner l'utilisateur vers le formulaire si le formulaire n'a pas été soumis
    header("Location: formulaire.html");
    exit();
}
?>
