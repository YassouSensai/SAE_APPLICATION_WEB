<?php
session_start();
include("../../Autres/fonctions_generales.php");

if (isset($_SESSION['utilisateur']) && isset($_POST['ticket_attribue'], $_POST['nouveau_statut'])) {
    $username = $_SESSION['utilisateur'];
    $ticketId = $_POST['ticket_attribue'];
    $nouveauStatut = $_POST['nouveau_statut'];

    $connexion = connectDB();

    $query = "UPDATE Ticket SET status_tic = ? WHERE id_tic = ?";
    $params = ['ii', $nouveauStatut, $ticketId];
    $resultat = prepareAndExecute($connexion, $query, $params);

    mysqli_close($connexion);

    if (!$resultat) {
        header('Location: ../tableau_de_bord_utilisateur.php?modif_statut=succes');
    } else {
        header('Location: ../tableau_de_bord_utilisateur.php?modif_statut=echec');
    }
} else {
    // Rediriger l'utilisateur vers une page d'erreur
    header('Location: ../tableau_de_bord_utilisateur.php?modif_statut=erreur');
}
?>
