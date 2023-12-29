<?php

session_start();
include("../Autres/fonctions.php");
include("../Crypto/crypto.php");

if (isset($_SESSION['nb1']) && isset($_SESSION['nb2'])) {
    $nb1 = $_SESSION['nb1'];
    $nb2 = $_SESSION['nb2'];
    $result_captcha = $nb1 * $nb2;

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['captcha']) && isset($_POST['user-type'])) {

        // Récupération des données de connexion utilisateur
        $username = htmlspecialchars($_POST['username']);
        $password = RC4("password",htmlspecialchars($_POST['password']));
        $captcha = htmlspecialchars($_POST['captcha']);
        $table_user = htmlspecialchars($_POST['user-type']);

        if ($result_captcha == $captcha) {

            $connexion = connectDB();

            $query = "SELECT * FROM ".$table_user." WHERE identifiant = ? AND mdp = ?";
            $params = ["ss", $username, $password];
            $resultat = prepareAndExecute($connexion, $query, $params);

            if (mysqli_num_rows($resultat) > 0) {
                $_SESSION['utilisateur'] = $username;
                $_SESSION['table_user'] = $table_user;


                header('Location: ../PagesUtilisateur/utilisateur.php');


                exit();
            } else {
                header('Location: connexion.php?err');
                exit;
            }

            // Fermeture de la requête préparée
            mysqli_stmt_close($prep);
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
}
?>
