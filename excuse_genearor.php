<!DOCTYPE html>
<html>
  <head>
    <title>Apology Generator</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <h3>Apology Generator</h3>
    <form method="post" action="excuse_generator.php">
      <label for="child_name">Name of the child:</label>
      <input type="text" id="child_name" name="child_name" required>

      <label for="child_gender">Gender of the child:</label>
      <input type="radio" id="girl" name="child_gender" value="girl" required>
      <label for="girl">Girl</label>
      <input type="radio" id="boy" name="child_gender" value="boy" required>
      <label for="boy">Boy</label>

      <label for="teacher_name">Name of the teacher:</label>
      <input type="text" id="teacher_name" name="teacher_name" required>

      <label for="excuse_reason">Reason for the absence:</label>
      <input type="radio" id="illness" name="excuse_reason" value="illness" required>
      <label for="illness">Illness</label>
      <input type="radio" id="pet_death" name="excuse_reason" value="pet_death" required>
      <label for="pet_death">Death of the pet (or a family member)</label>
      <input type="radio" id="extra_curricular" name="excuse_reason" value="extra_curricular" required>
      <label for="extra_curricular">Significant extra-curricular activity</label>
      <input type="radio" id="other" name="excuse_reason" value="other" required>
      <label for="other">Other</label>

      <input type="submit" value="Generate Apology">
    </form>

    <?php
      if (isset($_GET['submit'])) {
        // Récupère les valeurs du formulaire
        $child_name = $_POST["child_name"];
        $child_gender = $_POST["child_gender"];
        $teacher_name = $_POST["teacher_name"];
        $excuse_reason = $_POST["excuse_reason"];
        // Génère l'excuse appropriée
        $excuse = generateExcuse($child_name, $child_gender, $teacher_name, $excuse_reason);
        // Affiche l'excuse générée
        echo '<div class="excuse">' . $excuse . '</div>';
      }

      function generateExcuse($child_name, $child_gender, $teacher_name, $excuse_reason) {
        $date = date("l, \\t\\h\\e jS F Y"); // Récupère la date actuelle
        $apologies = []; // Tableau des excuses correspondant à chaque option
        // Génère une excuse appropriée en fonction de la raison sélectionnée
        switch ($excuse_reason) {
          case "illness":
            $apologies = [
              "Unfortunately, $child_name caught a cold and is unable to attend school today.",
              "Due to an unexpected illness, $child_name is unable to join the class today.",
              "We regret to inform you that $child_name is sick and needs to rest at home.",
              "Please excuse $child_name's absence as they are currently unwell and unable to attend school."
            ];
            break;
          case "pet_death":
            $apologies = [
              "We are sad to inform you that $child_name's beloved pet passed away, and they are unable to attend school today.",
              "Unfortunately, there has been a loss in our family, and $child_name is emotionally affected, requiring their absence from school.",
              "Due to the sudden demise of a family member, $child_name will not be able to attend school today.",
              "Please understand that $child_name is grieving the loss of a pet and needs some time off from school.",
              "We regret to inform you that $child_name is mourning the loss of a dear pet and needs to be absent from school."
            ];
            break;
          case "extra_curricular":
            $apologies = [
              "We apologize for $child_name's absence as they are participating in a significant extra-curricular activity that requires their presence today.",
              "Please excuse $child_name's absence as they are representing the school in an important event today.",
              "Due to $child_name's involvement in a special extracurricular event, they will be absent from school today.",
              "We regret to inform you that $child_name won a prestigious competition and is required to attend the prize ceremony today.",
              "We would like to inform you that $child_name has an important extracurricular commitment and will be absent from school today."
            ];
            break;
          case "other":
            $apologies = [
              "We apologize for $child_name's absence due to unforeseen circumstances beyond our control.",
              "Unfortunately, $child_name will not be able to attend school today due to an unavoidable situation.",
              "Due to a family emergency, $child_name is unable to join the class today.",
              "Please understand that $child_name has encountered an unexpected situation, resulting in their absence from school.",
              "We regret to inform you that $child_name is unable to attend school today due to reasons beyond our control."
            ];
            break;
        }

        if (count($apologies) > 0) {
          $selected_apology = $apologies[array_rand($apologies)]; // Sélectionne une excuse au hasard
          $excuse = "Dear $teacher_name,\n\nOn behalf of $child_name, I would like to apologize for their absence from school today, $date. $selected_apology\n\nThank you for your understanding.\n\nSincerely,\nParent";
          return nl2br(htmlspecialchars($excuse)); // Convertit les sauts de ligne en balises <br> et échappe les caractères spéciaux
        } else {
          return "Invalid excuse reason selected."; 
        }
      }
    ?>
  </body>
</html>
