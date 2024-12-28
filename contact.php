<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$email = $_POST['email'];
$message = $_POST['message'];

// Créer une instance de PHPMailer
$mail = new PHPMailer(true);

try {
    // Paramètres SMTP (Gmail)
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tomcd76@gmail.com'; // Votre adresse Gmail
    $mail->Password = 'yvwt rtyt jrnv jxtf'; // Votre mot de passe Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Destinataire
    $mail->setFrom($email, $nom);
    $mail->addAddress('tomcd76@gmail.com'); // Votre adresse Gmail

    // Contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Nouveau message depuis votre site web';
    $mail->Body    = "Nom: $nom <br> Email: $email <br> Message: $message";

    // Envoyer l'e-mail
    $mail->send();
    $message = 'Votre message a été envoyé avec succès.';
} catch (Exception $e) {
    $message = 'Erreur lors de l\'envoi du message : '. $mail->ErrorInfo;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <style>
        /* Ajouter un style à la classe confirmation-message */
        .confirmation-message {
            /* Utiliser une grille pour centrer le message */
            display: grid;
            place-items: center;
            height: 100vh;
            /* Ajouter un arrière-plan blanc avec une légère ombre */
            background-color: #f7f7f7;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Ajouter un padding pour créer un espace autour du message */
            padding: 20px;
            /* Utiliser une police inspirée d'Apple (San Francisco) */
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
            /* Ajouter un taille de police et un poids de police */
            font-size: 18px;
            font-weight: 500;
            /* Ajouter un couleur de texte qui contraste bien avec l'arrière-plan */
            color: #333;
        }
        /* Ajouter un style au bouton de retour */
        .back-button {
            /* Style du texte */
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
            font-size: 24px;
            font-weight: 500;
            color: #fff; /* Couleur du texte */
            text-decoration: none; /* Supprimer le soulignement */
            /* Style du bouton */
            display: inline-block;
            padding: 15px 30px; /* Espacement intérieur du bouton */
            background-color: #007AFF; /* Couleur de fond du bouton */
            border-radius: 20px; /* Rayon de bordure pour un effet arrondi */
            /* Effet de zoom au survol */
            transition: transform 0.3s ease;
        }
        .back-button:hover {
            transform: scale(1.1); /* Augmenter la taille du bouton au survol */
        }
    </style>
</head>
<body>

<!-- Afficher le message de confirmation -->
<div class="confirmation-message">
    <?php echo $message;?>
    <!-- Bouton de retour -->
    <a href="index.html" class="back-button">Revenir en arrière</a>
</div>

</body>
</html>
