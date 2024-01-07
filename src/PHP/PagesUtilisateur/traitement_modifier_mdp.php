<?php
session_start();
include("../Autres/fonctions.php");
include("../Crypto/crypto.php");


if (isset($_SESSION['nb1']) && isset($_SESSION['nb2']) && isset($_SESSION['utilisateur'])) {
    $username = $_SESSION['utilisateur'];

    if (isset($_POST['ancien_mdp'], $_POST['nouveau_mdp'], $_POST['nouveau_mdp2'], $_POST['captcha'])) {
        $ancien_mdp = RC4("password",htmlspecialchars($_POST['ancien_mdp']));
        $nouveau_mdp = RC4("password",htmlspecialchars($_POST['nouveau_mdp']));
        $nouveau_mdp2 = RC4("password", htmlspecialchars($_POST['nouveau_mdp2']));
        $captcha = htmlspecialchars($_POST['captcha']);

        if (verifCaptcha($captcha) && ($nouveau_mdp == $nouveau_mdp2)) {
            $connexion = connectDB();

            $query = "SELECT * FROM Utilisateur WHERE identifiant = ? AND mdp = ?;";
            $params = ['ss', $username, $ancien_mdp];

            $resultat = prepareAndExecute($connexion, $query, $params);

            if (mysqli_num_rows($resultat) > 0) {
                $query_maj = "UPDATE Utilisateur SET mdp = ? WHERE identifiant = ? AND mdp = ?;";
                $params_maj = ['sss', $nouveau_mdp, $username, $ancien_mdp];

                $resultat_maj = prepareAndExecute($connexion, $query_maj, $params_maj);

                mysqli_close($connexion);

                if (!$resultat_maj) {
                    header('Location: utilisateur.php?modif_profil=succes_mdp');
                } else {
                    header('Location: utilisateur.php?modif_profil=echec_mdp');
                }

            } else {
                mysqli_close($connexion);
                header('Location: utilisateur.php?modif_profil=else');
            }
        } else {
            header('Location: utilisateur.php?modif_profil=echec_mdp');
        }
    }
}else {
    header('Location: utilisateur.php?modif_profil=else');
}
