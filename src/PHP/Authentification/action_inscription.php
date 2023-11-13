<?php

session_start();

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
        $password = htmlspecialchars($_POST['password']);
        $confirm_password = htmlspecialchars($_POST['confirm_password']);
        $type_util = htmlspecialchars($_POST['type_util']);
        $captcha = htmlspecialchars($_POST['captcha']);

        if (($result_captcha == $captcha) && ($password === $confirm_password)) {

            // Informations de connexion à la base de données
            $serveur = "localhost";
            $utilisateur = "user_sae";
            $mot_de_passe = "azerty";
            $base_de_donnees = "sae_bd";

            $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

            // Vérification de la connexion
            if (!$connexion) {
                die("La connexion a échoué : " . mysqli_connect_error());
            }

            // Utilisation de requête préparée pour sécuriser l'insertion
            $query = "INSERT INTO Utilisateur (identifiant, nom_util, prenom_util, email_util, mdp, type_util) VALUES (?, ?, ?, ?, ?, ?)";

            // Hachage du mdp
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $prep = mysqli_prepare($connexion, $query);
            mysqli_stmt_bind_param($prep, "ssssss", $username, $nom, $prenom, $email, $hashed_password, $type_util);

            if (mysqli_stmt_execute($prep)) {
                header('Location: connexion.php?reussite');
                exit;
            } else {
                header('Location: inscription.php?err');
                exit;
            }

            mysqli_stmt_close($stmt);
            mysqli_close($connexion);
        } else {
            header('Location: inscription.php?err');
            exit;
        }
    } else {
        header('Location: inscription.php?err');
        exit;
    }
}
?>
