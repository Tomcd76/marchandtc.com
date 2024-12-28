<?php
// Connexion à la base de données
$servername = "localhost";
$username = "MCD";
$password = "p@ssword";
$dbname = "Webtech";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


