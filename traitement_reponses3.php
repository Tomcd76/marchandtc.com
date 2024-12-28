<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats du questionnaire 3</title>
    <link rel="stylesheet" href="questionnaire.css">
</head>
<body class="bg-white">
  <div class="container mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold text-center mb-8">Résultats du questionnaire 3</h1>
    <link rel="stylesheet" href="questionnaire.css">

    <?php
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Connexion à la base de données
      require_once "config.php";

      // Initialiser une variable pour stocker le résultat des réponses
      $resultat_reponses = "";

      // Récupérer les réponses soumises par l'utilisateur
      foreach ($_POST as $key => $value) {
        // Vérifier si le champ est une réponse à une question du questionnaire 3
        if (strpos($key, "reponse3_") === 0) {
          // Extraire l'ID de la question
          $question_id = substr($key, strlen("reponse3_"));

          // Récupérer la réponse de l'utilisateur
          $reponse_utilisateur = $conn->real_escape_string($value); // Échapper les caractères spéciaux pour éviter les injections SQL

          // Récupérer l'ID de la réponse correcte pour cette question
          $sql_correct_answer = "SELECT reponse_correcte FROM questions3 WHERE ID = $question_id";
          $result_correct_answer = $conn->query($sql_correct_answer);

          if ($result_correct_answer && $result_correct_answer->num_rows > 0) {
            $row_correct_answer = $result_correct_answer->fetch_assoc();
            $reponse_correcte = $row_correct_answer['reponse_correcte'];

            // Vérifier si la réponse de l'utilisateur est correcte
            if ($reponse_utilisateur == $reponse_correcte) {
              $resultat_reponses .= "<p class='text-lg font-medium mb-2'>Réponse pour la question $question_id correcte.</p>";
              $correcte = 1; // Réponse correcte
            } else {
              $resultat_reponses .= "<p class='text-lg font-medium mb-2'>Réponse pour la question $question_id incorrecte.</p>";
              $correcte = 0; // Réponse incorrecte
            }

            // Insérer la réponse de l'utilisateur dans la table reponses_utilisateurs3
            $sql_insert_reponse = "INSERT INTO reponses_utilisateurs3 (id_question, reponse_utilisateur, correcte) VALUES ('$question_id', '$reponse_utilisateur', '$correcte')";
            if ($conn->query($sql_insert_reponse) === TRUE) {
              $resultat_reponses .= "<p class='text-lg'>Réponse pour la question $question_id enregistrée avec succès dans la base de données.</p>";
            } else {
              $resultat_reponses .= "<p class='text-lg'>Erreur lors de l'enregistrement de la réponse pour la question $question_id dans la base de données : " . $conn->error . "</p>";
            }
          } else {
            $resultat_reponses .= "<p class='text-lg'>Erreur lors de la récupération de la réponse correcte pour la question $question_id.</p>";
          }
        }
      }

      // Afficher le résultat des réponses
      echo $resultat_reponses;

      // Calcul du score de réussite
      $nombre_questions = 8; // Remplacez 3 par le nombre total de questions dans le questionnaire 3
      $nombre_correct = 0;

      // Compter le nombre de réponses correctes
      foreach ($_POST as $key => $value) {
        if (strpos($key, "reponse3_") === 0) {
          $question_id = substr($key, strlen("reponse3_"));
          $sql_correct_answer = "SELECT reponse_correcte FROM questions3 WHERE ID = $question_id";
          $result_correct_answer = $conn->query($sql_correct_answer);
          if ($result_correct_answer && $result_correct_answer->num_rows > 0) {
            $row_correct_answer = $result_correct_answer->fetch_assoc();
            $reponse_correcte = $row_correct_answer['reponse_correcte'];
            if ($value == $reponse_correcte) {
              $nombre_correct++;
            }
          }
        }
      }

      // Calcul du score en pourcentage
      $score = ($nombre_correct / $nombre_questions) * 100;

      // Affichage du score
      echo "<p class='text-3xl font-bold text-center mb-8'>Score de réussite : " . round($score, 2) . "%</p>";

// Récupérer la correction de chaque question à choix multiple
$sql_correction_questions = "SELECT q.question, c.choix FROM questions3 q INNER JOIN choix_reponses3 c ON q.reponse_correcte = c.id";
$result_correction_questions = $conn->query($sql_correction_questions);

// Vérifier si la requête a réussi
if ($result_correction_questions && $result_correction_questions->num_rows > 0) {
    echo "<div class='bg-white rounded-lg shadow p-4 mb-4'>";
    echo "<h2 class='text-2xl font-bold mb-4'>Correction des questions</h2>";
    while ($row = $result_correction_questions->fetch_assoc()) {
        echo "<p class='text-lg font-medium mb-2'>Question : " . $row['question'] . "</p>";
        echo "<p class='text-lg mb-2'>Réponse correcte : " . $row['choix'] . "</p>";
    }
    echo "</div>";
} else {
    echo "<p class='text-lg'>Aucune correction trouvée.</p>";
}

      // Fermer la connexion à la base de données
      $conn->close();
    } else {
      echo "<p class='text-lg'>Le formulaire n'a pas été soumis.</p>";
    }
    ?>
  </div>
</body>
</html>
