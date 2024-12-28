<?php
// Définir le cookie pour suivre la page visitée
if (!isset($_COOKIE['page_visitee'])) {
    setcookie('page_visitee', $_SERVER['REQUEST_URI'], time() + 3600); // Expire dans 1 heure
}

// Définir le cookie pour suivre la durée de la visite
if (!isset($_COOKIE['heure_arrivee'])) {
    setcookie('heure_arrivee', time(), time() + 3600); // Expire dans 1 heure
}
?>
