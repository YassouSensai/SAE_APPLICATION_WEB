<?php

session_start();
include("../../Autres/fonctions_generales.php");
include("../../Crypto/crypto.php");

$action = '';
$liste = '';

if (isset($_SESSION['liste'])) {
    $liste = $_SESSION['liste'];
}

if (isset($_SESSION['action'])) {
    $action = $_SESSION['action'];
}

if (isset($_POST['identifiant']) && isset($_POST['mdp']) && isset($_POST['nom_tech']) && isset($_POST['prenom_tech'])) {
    $identifiant = htmlspecialchars($_POST['identifiant']);
    $mdp = RC4("password", htmlspecialchars($_POST['mdp']));
    $nom_tech = htmlspecialchars($_POST['nom_tech']);
    $prenom_tech = htmlspecialchars($_POST['prenom_tech']);

    $connexion = connectDB();

    // Vérifier si l'identifiant est déjà utilisé
    $checkQuery = "SELECT * FROM technicien WHERE identifiant = ?";
    $checkParams = ["s", $identifiant];
    $checkResult = prepareAndExecute($connexion, $checkQuery, $checkParams);

    if (mysqli_num_rows($checkResult) > 0) {
        header("Location: ../tableau_de_bord_utilisateur.php?inscr=echec_id&action=".$action."&liste=".$liste);
    } else {
        // Insérer le nouveau technicien dans la table Utilisateur
        $insertQuery = "INSERT INTO technicien (identifiant, nom_tech, prenom_tech, mdp) VALUES (?, ?, ?, ?)";
        $insertParams = ["ssss", $identifiant, $nom_tech, $prenom_tech, $mdp];
        prepareAndExecute($connexion, $insertQuery, $insertParams);


        logActivity($_SESSION['username'], 1, "L'administrateur web a inscrit un nouveau technicien avec l'identifiant $identifiant.");

        header("Location: ../tableau_de_bord_utilisateur.php?inscr=ok&action=".$action."&liste=".$liste);

    }

    mysqli_close($connexion);
} else {
    header("Location: ../tableau_de_bord_utilisateur.php?inscr=else&action=".$action."&liste=".$liste);

}
?>
