<?php
session_start();
include("../../Autres/fonctions_generales.php");

if (isset($_SESSION['utilisateur'], $_POST['ticket_non_attribue'])) {
    $username = $_SESSION['utilisateur'];
    $ticketNonAttribue = $_POST['ticket_non_attribue'];

    $connexion = connectDB();

    // Récupérer l'ID réel du ticket en utilisant le compteur
    $queryTicket = "SELECT id_tic FROM Ticket WHERE tech_charge_tic IS NULL ORDER BY date_crea_tic ASC";
    $resultatTicket = prepareAndExecute($connexion, $queryTicket);

    for ($i = 1; $i <= $ticketNonAttribue; $i++) {
        $rowTicket = mysqli_fetch_assoc($resultatTicket);
        $idTicket = $rowTicket['id_tic'];
    }

    // Mettre à jour la base de données en attribuant le ticket au technicien
    $queryUpdate = "UPDATE Ticket SET tech_charge_tic = ? WHERE id_tic = ?";
    $paramsUpdate = ['ss', $username, $idTicket];
    $resultatUpdate = prepareAndExecute($connexion, $queryUpdate, $paramsUpdate);

    mysqli_close($connexion);

    if (!$resultatUpdate) {
        header('Location: ../tableau_de_bord_utilisateur.php?attribution_ticket=succes');
    } else {
        header('Location: ../tableau_de_bord_utilisateur.php?attribution_ticket=echec');
    }
} else {
    header('Location: ../tableau_de_bord_utilisateur.php?attribution_ticket=else');
}
?>
