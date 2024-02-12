<?php

session_start();
include("../Autres/fonctions_generales.php");
include("../Crypto/crypto.php");

if (isset($_SESSION['nb1']) && isset($_SESSION['nb2'])) {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['user-type'])) {
        // Récupération des données de connexion utilisateur
        $username = htmlspecialchars($_POST['username']);
        $captcha = htmlspecialchars($_POST['captcha']);
        $table_user = htmlspecialchars($_POST['user-type']);

        $password = RC4("password",htmlspecialchars($_POST['password']));


        $connexion = connectDB();

        $query = "SELECT * FROM ".$table_user." WHERE identifiant = ? AND mdp = ?";
        $params = ["ss", $username, $password];

        $resultat = prepareAndExecute($connexion, $query, $params);

        if (mysqli_num_rows($resultat) > 0) {
            $_SESSION['utilisateur'] = $username;
            $_SESSION['table_user'] = $table_user;

            // Ajouter une entrée au journal d'activité pour la connexion réussie
            logActivity($username, 1, "L'utilisateur $username s'est connecté avec succès !");

            header('Location: ../PagesUtilisateur/utilisateur.php');
            exit();
        } else {
            // Ajouter une entrée au journal d'activité pour l'échec de connexion
            logActivity($username, 1, "L'utilisateur $username n'a pas pu se connecter.");

            header('Location: connexion.php?err');
            exit();
        }

        // Fermeture de la connexion
        mysqli_close($connexion);
    } else {
        header('Location: connexion.php?err');
        exit;
    }
} else {
    header('Location: connexion.php?err');
    exit;
}
?>

