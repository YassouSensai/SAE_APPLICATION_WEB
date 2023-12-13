<?php
session_start();
include("../Autres/fonctions.php");

if (isset($_SESSION['utilisateur']) && isset($_POST['mdp'])) {
    $username = $_SESSION['utilisateur'];
    $mdp = $_POST['mdp'];

    $connexion = connectDB();

    $query = "SELECT * FROM Utilisateur WHERE identifiant = ? AND mdp = ?;";
    $params = ['ss', $username, $mdp];
    $resultat = prepareAndExecute($connexion, $query, $params);

    if (mysqli_num_rows($resultat) > 0) {
        if (isset($_POST['sujet_ticket'],$_POST['niveau_urgence'],$_POST['description_ticket'])) {
            $sujet_ticket = $_POST['sujet_ticket'];
            $niveau_urgence = $_POST['niveau_urgence'];
            $description_ticket = $_POST['description_ticket'];

            echo "Coucou $username ! Votre ticket ($sujet_ticket) a bien été créé aujourd'hui, le :".date('d/m/y');
        }
    }



} else {
    header('Location: utilisateur.php?ouvrir_ticket=else');
}
