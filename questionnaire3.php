<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionnaire 3</title>
    <link rel="stylesheet" href="questionnaire.css">
</head>
<body class="bg-white">
  <div class="container mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold text-center mb-8">Questionnaire 3</h1>
    <form action="traitement_reponses3.php" method="post" class="max-w-lg mx-auto">
      <?php
      // Connexion à la base de données
      require_once "config.php";

      // Récupérer les questions depuis la base de données
      $sql = "SELECT ID, question FROM questions3";

      // Exécuter la requête
      $result = $conn->query($sql);

      // Vérifier s'il y a des questions à afficher
      if ($result->num_rows > 0) {
        // Afficher chaque question
        while ($row = $result->fetch_assoc()) {
          echo "<div class='bg-white rounded-lg shadow p-4 mb-4'>";
          echo "<p class='text-lg font-medium mb-2'>" . $row["question"] . "</p>";

          // Récupérer les choix de réponses pour cette question
          $choices_sql = "SELECT ID, choix FROM choix_reponses3 WHERE id_question=" . $row["ID"];
          $choices_result = $conn->query($choices_sql);

          // Vérifier s'il y a des choix de réponses à afficher
          if ($choices_result->num_rows > 0) {
            // Afficher chaque choix de réponse
            while ($choice_row = $choices_result->fetch_assoc()) {
              echo "<div class='flex items-center mb-2'>";
              echo "<input type='radio' name='reponse3_" . $row["ID"] . "' value='" . $choice_row["ID"] . "' class='mr-2' id='reponse3_" . $row["ID"] . "_" . $choice_row["ID"] . "'>";
              echo "<label for='reponse3_" . $row["ID"] . "_" . $choice_row["ID"] . "' class='text-lg'>" . $choice_row["choix"] . "</label>";
              echo "</div>";
            }
          }
          echo "</div>";
        }
      } else {
        echo "<p class='text-center text-lg'>Aucune question trouvée.</p>";
      }

      // Fermer la connexion à la base de données
      $conn->close();
      ?>
      <div class="flex justify-center mt-4">
        <input type="submit" value="Soumettre" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
      </div>
    </form>
  </div>
</body>
</html>
