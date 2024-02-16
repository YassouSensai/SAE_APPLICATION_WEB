<?php
session_start();
include("../../Autres/fonctions_generales.php");
include("../../Crypto/crypto.php");

if (isset($_SESSION['nb1'], $_SESSION['nb2'], $_SESSION['utilisateur'])) {
    $username = $_SESSION['utilisateur'];

    if (isset($_POST['ancien_mdp'], $_POST['nouveau_mdp'], $_POST['nouveau_mdp2'], $_POST['captcha'])) {
        $ancien_mdp = RC4("password", htmlspecialchars($_POST['ancien_mdp']));
        $nouveau_mdp = RC4("password", htmlspecialchars($_POST['nouveau_mdp']));
        $nouveau_mdp2 = RC4("password", htmlspecialchars($_POST['nouveau_mdp2']));
        $captcha = htmlspecialchars($_POST['captcha']);

        if (verifCaptcha($captcha) && ($nouveau_mdp == $nouveau_mdp2)) {
            $connexion = connectDB();

            if ($connexion) {
                $query = "SELECT * FROM utilisateur WHERE identifiant = ? AND mdp = ?";
                $params = ['ss', $username, $ancien_mdp];

                $resultat = prepareAndExecute($connexion, $query, $params);

                if ($resultat && mysqli_num_rows($resultat) > 0) {
                    $query_maj = "UPDATE utilisateur SET mdp = ? WHERE identifiant = ? AND mdp = ?";
                    $params_maj = ['sss', $nouveau_mdp, $username, $ancien_mdp];

                    $resultat_maj = prepareAndExecute($connexion, $query_maj, $params_maj);

                    if ($resultat_maj) {
                        header('Location: ../utilisateur.php?modif_profil=succes_mdp');
                        exit();
                    } else {
                        header('Location: ../utilisateur.php?modif_profil=echec_maj');
                        exit();
                    }
                } else {
                    header('Location: ../utilisateur.php?modif_profil=identifiants_invalides');
                    exit();
                }
            } else {
                header('Location: ../utilisateur.php?modif_profil=connexion_echouee');
                exit();
            }
        } else {
            header('Location: ../utilisateur.php?modif_profil=echec_captcha_ou_mdp');
            exit();
        }
    } else {
        header('Location: ../utilisateur.php?modif_profil=champs_incomplets');
        exit();
    }
} else {
    header('Location: ../utilisateur.php?modif_profil=erreur_session');
    exit();
}
?>
