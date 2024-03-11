<?php
if (isset($_POST["telecharger_csv"], $_POST['type_journal'])) {


    // Rediriger l'utilisateur vers la page principale après le téléchargement
    header('Location: ../index.php');
    exit();
}
?>
