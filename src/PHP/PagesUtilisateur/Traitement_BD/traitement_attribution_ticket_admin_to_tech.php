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


if (isset($_POST['ticket_libre']) && isset($_POST['technicien_attribue'])) {
    $ticketIndex = htmlspecialchars($_POST['ticket_libre']);
    $technicienId = htmlspecialchars($_POST['technicien_attribue']);

    $connexion = connectDB();

    // Sélectionner les tickets non attribués
    $queryTickets = "SELECT id_tic, objet, date_crea_tic FROM Ticket WHERE tech_charge_tic IS NULL ORDER BY date_crea_tic DESC";
    $resultatTickets = prepareAndExecute($connexion, $queryTickets);

    // Sélectionner les techniciens avec le nombre de tickets actuels
    $queryTechniciens = "SELECT t.identifiant, COUNT(t2.id_tic) AS nb_tickets
                         FROM Technicien t
                         LEFT JOIN Ticket t2 ON t.identifiant = t2.tech_charge_tic
                         GROUP BY t.identifiant";
    $resultatTechniciens = prepareAndExecute($connexion, $queryTechniciens);

    // Récupérer le ticket sélectionné par l'index
    $compteur = 1;
    while ($row = mysqli_fetch_assoc($resultatTickets)) {
        if ($compteur == $ticketIndex) {
            $ticketId = $row['id_tic'];
            break;
        }
        $compteur++;
    }

    // Attribuer le ticket au technicien
    $updateQuery = "UPDATE Ticket SET tech_charge_tic = ? WHERE id_tic = ?";
    $updateParams = ["si", $technicienId, $ticketId];
    prepareAndExecute($connexion, $updateQuery, $updateParams);

    // Ajouter une entrée au journal d'activité pour l'attribution du ticket
    $username = $_SESSION['utilisateur'];
    logActivity($username, 0, "L'administrateur web a attribué le ticket avec l'ID $ticketId au technicien $technicienId.");

    mysqli_close($connexion);

    header("Location: ../tableau_de_bord_utilisateur.php?attr=ok&action=".$action."&liste=".$liste);
} else {
    header("Location: ../tableau_de_bord_utilisateur.php?attr=echec&action=".$action."&liste=".$liste);
}
?>
