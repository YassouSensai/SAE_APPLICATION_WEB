<?php
session_start();
include("../../Autres/fonctions_generales.php");
include("../../Crypto/crypto.php");



if (isset($_SESSION['utilisateur'], $_POST['mot_de_passe'])) {
    $connexion = connectDB();

    $username = $_SESSION['utilisateur'];
    $password = RC4("password", htmlspecialchars($_POST['mot_de_passe']));

    $query = "SELECT * FROM utilisateur WHERE identifiant = ? AND mdp = ?";
    $params = ['ss', $username, $password];

    $resultat = prepareAndExecute($connexion, $query, $params);

    if (mysqli_num_rows($resultat) > 0) {
        if (isset($_POST['nouveau_nom'], $_POST['nouveau_prenom'], $_POST['nouvel_email'])) {
            $nouveau_nom = $_POST['nouveau_nom'];
            $nouveau_prenom = $_POST['nouveau_prenom'];
            $nouvel_email = $_POST['nouvel_email'];

            $query_maj = "UPDATE utilisateur SET nom_util = ?, prenom_util = ?, email_util = ? WHERE identifiant = ?";
            $params_maj = ['ssss', $nouveau_nom, $nouveau_prenom, $nouvel_email, $username];

            $resultat_maj = prepareAndExecute($connexion, $query_maj, $params_maj);

            mysqli_close($connexion);

            if (!$resultat_maj) {
                header('Location: ../utilisateur.php?modif_profil=succes');
            } else {
                header('Location: ../utilisateur.php?modif_profil=echec');
            }

        } else {
            mysqli_close($connexion);
            header('Location: ../utilisateur.php?modif_profil=else');
        }
    } else {
        mysqli_close($connexion);
        header('Location: ../utilisateur.php?modif_profil=echec_mdp');
    }
} else {
    header('Location: ../utilisateur.php?modif_profil=else');
}



