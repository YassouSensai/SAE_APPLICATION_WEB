<?php

session_start();
include("../Autres/fonctions_generales.php");
include("../Crypto/crypto.php");

echo "<strong>Etape de démarrage</strong><br>";


if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['user-type'])) {
    $username = htmlspecialchars($_POST['username']);
    $table_user = htmlspecialchars($_POST['user-type']);

    $password = RC4("password", htmlspecialchars($_POST['password']));

    $connexion = connectDB();
    $query = "SELECT * FROM $table_user WHERE identifiant = ? AND mdp = ?";
    $params = ["ss", $username, $password];
    $resultat = prepareAndExecute($connexion, $query, $params);

    if (mysqli_num_rows($resultat) > 0) {
        $_SESSION['utilisateur'] = $username;
        $_SESSION['table_user'] = $table_user;

        logActivity($username, 1, "L'utilisateur $username s'est connecté avec succés.");
        header('Location: ../PagesUtilisateur/utilisateur.php');
        exit();

    } else {
        //ajout_csv($username,$password);
        logActivity($username, 1, "L'utilisateur $username n'a pas pu se connecter pour une raison inconnu.");
        header('Location: connexion.php?err');
        exit();
    }
} else {
    logActivity("FORM-ERROR", 1, "Le formulaire de connexion a été envoyé avec des champs non complété.");
    header('Location: connexion.php?err');
    exit();
}
?>
