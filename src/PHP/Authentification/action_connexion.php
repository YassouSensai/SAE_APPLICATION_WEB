<?php

session_start();
include("../Autres/fonctions_generales.php");
include("../Crypto/crypto.php");

echo "<strong>Etape de démarrage</strong><br>";

if (isset($_SESSION['nb1']) && isset($_SESSION['nb2'])) {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['captcha']) && isset($_POST['user-type'])) {
        // Récupération des données de connexion utilisateur
        echo "<strong>Etape de récupération des données de connexion utilisateur</strong><br>";
        $username = htmlspecialchars($_POST['username']);
        $captcha = htmlspecialchars($_POST['captcha']);
        $table_user = htmlspecialchars($_POST['user-type']);

        $password = RC4("password", htmlspecialchars($_POST['password']));

        if (verifCaptcha($captcha)) {
            echo "<strong>Etape de vérification du captcha</strong><br>";
            $connexion = connectDB();

            $query = "SELECT * FROM $table_user WHERE identifiant = ? AND mdp = ?";
            $params = ["ss", $username, $password];

            $resultat = prepareAndExecute($connexion, $query, $params);

            if (mysqli_num_rows($resultat) > 0) {
                echo "<strong>Etape de vérification des informations de connexion</strong><br>";
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
            // Ajouter une entrée au journal d'activité pour l'échec de connexion
            logActivity($username, 1, "L'utilisateur $username n'a pas pu se connecter.");

            header('Location: connexion.php?err');
            exit;
        }
    } else {
        header('Location: connexion.php?err');
        exit;
    }
} else {
    header('Location: connexion.php?err');
    exit;
}
?>
