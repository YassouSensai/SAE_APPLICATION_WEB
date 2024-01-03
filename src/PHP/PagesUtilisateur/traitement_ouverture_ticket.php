<?php
session_start();
include("../Autres/fonctions.php");
include("../Crypto/crypto.php");

if (isset($_SESSION['utilisateur']) && isset($_POST['mdp'])) {
    $username = $_SESSION['utilisateur'];
    $mdp = RC4('password',$_POST['mdp']);

    $connexion = connectDB();

    $query = "SELECT * FROM Utilisateur WHERE identifiant = ? AND mdp = ?;";
    $params = ['ss', $username, $mdp];
    $resultat = prepareAndExecute($connexion, $query, $params);

    if (mysqli_num_rows($resultat) > 0) {
        if (isset($_POST['sujet_ticket'], $_POST['niveau_urgence'], $_POST['description_ticket'], $_POST['salle'])) {
            $sujet_ticket = htmlspecialchars($_POST['sujet_ticket']);
            $niveau_urgence = htmlspecialchars($_POST['niveau_urgence']);
            $description_ticket = htmlspecialchars($_POST['description_ticket']);
            $salle = htmlspecialchars($_POST['salle']);

            $adresse_ip = $_SERVER['REMOTE_ADDR'];

            // Insertion du ticket dans la base de données
            $insert_query = "INSERT INTO Ticket (objet, desc_pb_tic, adresse_ip, salle, createur_tic, status_tic, nv_urgence_tic) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insert_params = ['sssssss', $sujet_ticket, $description_ticket, $adresse_ip, $salle, $username, 1, $niveau_urgence];

            $insert_result = prepareAndExecute($connexion, $insert_query, $insert_params);

            if ($insert_result) {
                logActivity($username, 0, "L'utilisateur $username a créé un ticket pour la salle $salle.");
                echo header('Location: utilisateur.php?ouvrir_ticket=ok');
            } else {
                logActivity($username, 0, "L'utilisateur $username n'a pas réussit a créé un ticket pour la salle $salle.");
                header('Location: utilisateur.php?ouvrir_ticket=else');
            }
        }
    } else {
        logActivity($username, 0, "L'utilisateur $username s'est trompé de mot de passe pour créé un ticket.");
        header('Location: utilisateur.php?ouvrir_ticket=echec_mdp');
    }

    mysqli_close($connexion);
} else {
    header('Location: utilisateur.php?ouvrir_ticket=else');
}
?>
