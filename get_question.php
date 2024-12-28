<?php
// Connexion à la base de données
require_once "config.php";

// Récupérer l'ID de la question depuis la requête GET
$questionId = $_GET["question_id"];

// Préparer la requête pour récupérer la question depuis la base de données
$sql = "SELECT question FROM questions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $questionId);
$stmt->execute();
$stmt->bind_result($question);
$stmt->fetch();
$stmt->close();

// Fermer la connexion à la base de données
$conn->close();

// Retourner la question sous forme de JSON
echo json_encode(["question" => $question]);
?>
