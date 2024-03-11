<?php

session_start();
include("../Autres/fonctions_generales.php");
include("../Crypto/crypto.php");

echo "<strong>Etape de démarrage</strong><br>";

if (isset($_SESSION['nb1']) && isset($_SESSION['nb2'])) {

    if (isset($_POST['username'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'], $_POST['confirm_password'], $_POST['type_util'], $_POST['captcha'])) {
        // Récupération des données d'inscription
        echo "<strong>Etape de récupération des données d'inscription</strong><br>";
        $username = htmlspecialchars($_POST['username']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $password = RC4("password", htmlspecialchars($_POST['password']));
        $confirm_password = RC4("password", htmlspecialchars($_POST['confirm_password']));
        $type_util = htmlspecialchars($_POST['type_util']);
        $captcha = htmlspecialchars($_POST['captcha']);

        if (verifCaptcha($captcha) && ($password === $confirm_password)) {
            echo "<strong>Etape de vérification du captcha et des mots de passe</strong><br>";
            $connexion = connectDB();

            $paramsVerif = ['s', $username];
            $queryVerif = "SELECT * FROM utilisateur WHERE identifiant = ?";
            $resultatVerif = prepareAndExecute($connexion, $queryVerif, $paramsVerif);

            if (mysqli_num_rows($resultatVerif) > 0) {
                header('Location: inscription.php?err=err_inscription_identifiant');
            } else {
                $query = "INSERT INTO utilisateur (identifiant, nom_util, prenom_util, email_util, mdp, type_util) VALUES (?, ?, ?, ?, ?, ?)";
                $params = ['ssssss', $username, $nom, $prenom, $email, $password, $type_util];
                $resultat = prepareAndExecute($connexion, $query, $params);

                if (!$resultat) {
                    logActivity($username, 1, "L'utilisateur $username vient de créer son compte.");
                    header('Location: connexion.php?reussite');
                    exit;
                } else {
                    logActivity($username, 1, "L'utilisateur $username n'a pas réussi à créer son compte.");
                    header('Location: inscription.php?err=err_inscription');
                    exit;
                }
            }
            mysqli_close($connexion);
        } else {
            logActivity($username, 1, "L'utilisateur $username n'a pas réussi à créer son compte en raison d'un captcha invalide ou d'un mot de passe diférent de l'autre.");
            header('Location: inscription.php?err=err_inscription');
            exit;
        }
    } else {
        logActivity("FORM-ERROR", 1, "Le formulaire d'inscription a été envoyé avec des champs vides.");
        header('Location: inscription.php?err=err_inscription');
        exit;
    }
}
?>
