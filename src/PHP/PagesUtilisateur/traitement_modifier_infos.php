<?php
session_start();

function connectDB() {
    $serveur = "localhost";
    $utilisateur = "user_sae";
    $mot_de_passe = "azerty";
    $base_de_donnees = "sae_bd";

    $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

    if (!$connexion) {
        die("La connexion a échoué : " . mysqli_connect_error());
    }

    return $connexion;
}

function prepareAndExecute($connexion, $query, $params = null) {
    $prep = mysqli_prepare($connexion, $query);

    if (!$prep) {
        die("La préparation de la requête a échoué : " . mysqli_error($connexion));
    }

    if ($params) {
        mysqli_stmt_bind_param($prep, ...$params);
    }

    mysqli_stmt_execute($prep);

    return mysqli_stmt_get_result($prep);
}

if (isset($_GET['typeModif'])) {
    $connexion = connectDB();

    if ($_GET['typeModif'] == 'profil') {
        if (isset($_SESSION['utilisateur'], $_POST['mot_de_passe'])) {
            $username = $_SESSION['utilisateur'];
            $password = $_POST['mot_de_passe']; // Pas besoin d'utiliser htmlspecialchars ici

            $query = "SELECT * FROM Utilisateur WHERE identifiant = ? AND mdp = ?";
            $params = ['ss', $username, $password];

            $resultat = prepareAndExecute($connexion, $query, $params);

            if (mysqli_num_rows($resultat) > 0) {
                if (isset($_POST['nouveau_nom'], $_POST['nouveau_prenom'], $_POST['nouvel_email'])) {
                    $nouveau_nom = $_POST['nouveau_nom'];
                    $nouveau_prenom = $_POST['nouveau_prenom'];
                    $nouvel_email = $_POST['nouvel_email'];

                    $query_maj = "UPDATE Utilisateur SET nom_util = ?, prenom_util = ?, email_util = ? WHERE identifiant = ?";
                    $params_maj = ['ssss', $nouveau_nom, $nouveau_prenom, $nouvel_email, $username];

                    $resultat_maj = prepareAndExecute($connexion, $query_maj, $params_maj);

                    mysqli_close($connexion);

                    if (!$resultat_maj) {
                        header('Location: utilisateur.php?modif_profil=succes');
                    } else {
                        header('Location: utilisateur.php?modif_profil=echec');
                    }
                }
            } else {
                mysqli_close($connexion);
                header('Location: utilisateur.php?modif_profil=echec_mdp');
            }
        } else {
            mysqli_close($connexion);
            header('Location: utilisateur.php?modif_profil=else');
        }
    } elseif ($_GET['typeModif'] == 'mdp') {
        if (isset($_SESSION['utilisateur'], $_POST['ancien_mdp'], $_POST['nouveau_mdp'], $_POST['nouveau_mdp2'], $_POST['captcha'], $_POST['nb1'], $_POST['nb2'])) {
            $username = $_SESSION['utilisateur'];
            $ancien_mdp = $_POST['ancien_mdp'];
            $nouveau_mdp = $_POST['nouveau_mdp'];
            $nouveau_mdp2 = $_POST['nouveau_mdp2'];
            $captcha = $_POST['captcha'];
            $nb1 = $_POST['nb1'];
            $nb2 = $_POST['nb2'];

            $verifCaptcha = $nb1 * $nb1;

            if ($verifCaptcha == $captcha && $nouveau_mdp == $nouveau_mdp2) {
                $query = "SELECT * FROM Utilisateur WHERE identifiant = ? AND mdp = ?";
                $params = ['ss', $username, $ancien_mdp];

                $resultat = prepareAndExecute($connexion, $query, $params);

                if (mysqli_num_rows($resultat) > 0) {
                    $query_maj = "UPDATE Utilisateur SET mdp = ? WHERE identifiant = ? AND mdp = ?";
                    $prep_maj = mysqli_prepare($connexion, $query_maj);

                    if (!$prep_maj) {
                        mysqli_close($connexion);
                        header('Location: utilisateur.php?modif_mdp=else');
                    }

                    $params_maj = ['sss', $nouveau_mdp, $username, $ancien_mdp];

                    $resultat_maj = prepareAndExecute($connexion, $query_maj, $params_maj);

                    mysqli_close($connexion);

                    if ($resultat_maj) {
                        header('Location: utilisateur.php?modif_mdp=succes');
                    } else {
                        header('Location: utilisateur.php?modif_mdp=echec');
                    }
                } else {
                    mysqli_close($connexion);
                    header('Location: utilisateur.php?modif_mdp=else');
                }
            } else {
                mysqli_close($connexion);
                header('Location: utilisateur.php?modif_mdp=echec_mdp_captcha');
            }
        } else {
            mysqli_close($connexion);
            header('Location: utilisateur.php?modif_mdp=else');
        }
    } else {
        mysqli_close($connexion);
        header('Location: utilisateur.php?modif_type=invalid');
    }


    mysqli_close($connexion);
} else {
    header('Location: utilisateur.php?modif_type=missing');
}
?>
