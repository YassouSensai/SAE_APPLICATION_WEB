<?php
session_start();
include("../Autres/fonctions.php");

// Vérifier si l'utilisateur est connecté et a les autorisations nécessaires
if (isset($_SESSION['utilisateur']) && isset($_POST['ticket_attribue'], $_POST['nouveau_statut'])) {
    $username = $_SESSION['utilisateur'];
    $ticketId = $_POST['ticket_attribue'];
    $nouveauStatut = $_POST['nouveau_statut'];

    // Ajoutez ici le code pour vous connecter à la base de données
    $connexion = connectDB();

    // Mettez à jour le statut du ticket dans la base de données
    $query = "UPDATE Ticket SET status_tic = ? WHERE id_tic = ?";
    $params = ['ii', $nouveauStatut, $ticketId];
    $resultat = prepareAndExecute($connexion, $query, $params);

    // Ajoutez ici le code pour fermer la connexion à la base de données
    mysqli_close($connexion);

    if ($resultat) {
        // Rediriger l'utilisateur vers une page de succès
        header('Location: utilisateur.php?modif_statut=succes');
    } else {
        // Rediriger l'utilisateur vers une page d'échec
        header('Location: utilisateur.php?modif_statut=echec');
    }
} else {
    // Rediriger l'utilisateur vers une page d'erreur
    header('Location: utilisateur.php?modif_statut=erreur');
}
?>
