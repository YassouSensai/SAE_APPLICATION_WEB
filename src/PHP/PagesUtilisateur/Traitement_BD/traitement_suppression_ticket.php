<?php

session_start();
include("../../Autres/fonctions_generales.php");

$action = '';
$liste = '';

if (isset($_SESSION['liste'])) {
    $liste = $_SESSION['liste'];
}

if (isset($_SESSION['action'])) {
    $action = $_SESSION['action'];
}

if (isset($_POST['ticket_supprimer'])) {
    $ticketId = htmlspecialchars($_POST['ticket_supprimer']);

    $connexion = connectDB();

    // Vérifier si le ticket existe avant de le supprimer
    $checkQuery = "SELECT * FROM ticket WHERE id_tic = ?";
    $checkParams = ["i", $ticketId];
    $checkResult = prepareAndExecute($connexion, $checkQuery, $checkParams);

    if (mysqli_num_rows($checkResult) > 0) {
        // Supprimer le ticket
        $deleteQuery = "DELETE FROM ticket WHERE id_tic = ?";
        $deleteParams = ["i", $ticketId];
        prepareAndExecute($connexion, $deleteQuery, $deleteParams);

        // Ajouter une entrée au journal d'activité pour la suppression du ticket
        $username = $_SESSION['utilisateur'];
        logActivity($username, 0, "L'administrateur web a supprimé le ticket avec l'ID $ticketId.");
        header("Location: ../tableau_de_bord_utilisateur.php?suppr=ok&action=".$action."&liste=".$liste);

    } else {
        header("Location: ../tableau_de_bord_utilisateur.php?suppr=echec&action=".$action."&liste=".$liste);
    }

    mysqli_close($connexion);
} else {
    header("Location: ../tableau_de_bord_utilisateur.php?suppr=else&action=".$action."&liste=".$liste);
}
?>
