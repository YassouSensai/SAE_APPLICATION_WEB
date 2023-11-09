<?php
session_start();

if (isset($_SESSION['nb1']) && isset($_SESSION['nb2'])) {
    $nb1 = $_SESSION['nb1'];
    $nb2 = $_SESSION['nb2'];
    $result_captcha = $nb1 * $nb2;

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['captcha']) && isset($_POST['user-type'])) {

        // Récupération des données de connexion utilisateur
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $captcha = htmlspecialchars($_POST['captcha']);
        $table_user = htmlspecialchars($_POST['user-type']);

        if ($result_captcha == $captcha) {

            // Informations de connexion à la base de données
            $serveur = "localhost";
            $utilisateur = "root";
            $mot_de_passe = "";
            $base_de_donnees = "sae_bd";

            $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

            // Vérification de la connexion
            if (!$connexion) {
                die("La connexion a échoué : ".mysqli_connect_error());
            }

            // Utilisation directe du nom de table
            $query = "SELECT * FROM ".$table_user." WHERE identifiant = ? AND mdp = ?";

            $prep = mysqli_prepare($connexion, $query);
            mysqli_stmt_bind_param($prep, 'ss', $username, $password);
            mysqli_stmt_execute($prep);
            $resultat = mysqli_stmt_get_result($prep);

            if (mysqli_num_rows($resultat) > 0) {
                $_SESSION['utilisateur'] = $username;
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
