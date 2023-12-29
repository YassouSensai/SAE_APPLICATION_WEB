<?php

session_start();
include("../Autres/fonctions.php");
include("../Crypto/crypto.php");

if (isset($_SESSION['nb1']) && isset($_SESSION['nb2'])) {
    $nb1 = $_SESSION['nb1'];
    $nb2 = $_SESSION['nb2'];
    $result_captcha = $nb1 * $nb2;

    if (isset($_POST['username'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'], $_POST['confirm_password'], $_POST['type_util'], $_POST['captcha'])) {
        // Récupération des données d'inscription
        $username = htmlspecialchars($_POST['username']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $password = RC4("password",htmlspecialchars($_POST['password']));
        $confirm_password = RC4("password",htmlspecialchars($_POST['confirm_password']));
        $type_util = htmlspecialchars($_POST['type_util']);
        $captcha = htmlspecialchars($_POST['captcha']);

        if (($result_captcha == $captcha) && ($password === $confirm_password)) {
            $connexion = connectDB();

            $paramsVerif = ['s', $username];
            $queryVerif = "SELECT * FROM Utilisateur WHERE identifiant = ?";
            $resultatVerif = prepareAndExecute($connexion, $queryVerif, $paramsVerif);

            if (mysqli_num_rows($resultatVerif) > 0) {
                header('Location: inscription.php?err=err_inscription_identifiant');
            } else {
                $query = "INSERT INTO Utilisateur (identifiant, nom_util, prenom_util, email_util, mdp, type_util) VALUES (?, ?, ?, ?, ?, ?)";
                $params = ['ssssss', $username, $nom, $prenom, $email, $password, $type_util];
                $resultat = prepareAndExecute($connexion, $query, $params);

                if (!$resultat) {
                    header('Location: connexion.php?reussite');
                    exit;
                } else {
                    header('Location: inscription.php?err=err_inscription');
                    exit;
                }
            }
            mysqli_close($connexion);
        } else {
            header('Location: inscription.php?err=err_inscription');
            exit;
        }
    } else {
        header('Location: inscription.php?err=err_inscription');
        exit;
    }
}
?>
