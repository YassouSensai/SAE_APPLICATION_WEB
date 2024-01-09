<?php
/* Cette page php regroupe les fonctions nécessaires pour les cas d'utilisations des techniciens dont :
 * - La fonction afficherFormChoixTicketsNonAttribues() qui permet aux techniciens de s'attribuer un ticket
 * - La fonction afficherFormModifierStatutTicket() qui permet aux techniciens de modifier le status d'un ticket
 * */


// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Fonction qui permet d'afficher les tickets que l'on peut s'attribuer en tant que technicien */
function afficherFormChoixTicketsNonAttribues() {
    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";
    $connexion = connectDB();

    $query = "SELECT id_tic, objet, date_crea_tic FROM Ticket WHERE tech_charge_tic IS NULL ORDER BY date_crea_tic DESC";
    $resultat = prepareAndExecute($connexion, $query);

    echo "<form action='Traitement_BD/traitement_attribuer_ticket.php' method='post'>";
    echo "<label for='ticket_non_attribue'>Choisir un ticket non attribué :</label>";
    echo "<select id='ticket_non_attribue' name='ticket_non_attribue' required>";

    $compteur = 1;

    while ($row = mysqli_fetch_assoc($resultat)) {
        $dateCreation = date('d/m/Y', strtotime($row['date_crea_tic']));
        echo "<option value='" . htmlspecialchars($compteur) . "'>" . $compteur . " - " . htmlspecialchars($row['objet']) . " - " . $dateCreation . "</option>";
        $compteur++;
    }

    echo "</select>";
    echo "<input type='submit' value='Attribuer'>";
    echo "</form>";

    mysqli_close($connexion);
}

// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Fonction qui permet d'afficher un formulaire pour les techniciens afin qu'ils puissent modifier le statut d'un ticket */
function afficherFormModifierStatutTicket($username) {

    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";
    $connexion = connectDB();

    $query = "SELECT t.id_tic, t.objet, t.desc_pb_tic, t.adresse_ip, t.salle, s.libelle_statut_tic AS statut, u.libelle_nv_urgence AS urgence
              FROM Ticket t
              JOIN StatutTicket s ON t.status_tic = s.id_statut_tic
              JOIN NiveauUrgence u ON t.nv_urgence_tic = u.id_nv_urgence
              WHERE t.tech_charge_tic = ?
              ORDER BY t.date_crea_tic DESC";
    $params = ['s', $username];
    $resultat = prepareAndExecute($connexion, $query, $params);

    echo "<form action='Traitement_BD/traitement_modifier_statut_ticket.php' method='post'>";
    echo "<label for='ticket_attribue'>Choisir un ticket attribué :</label>";
    echo "<select id='ticket_attribue' name='ticket_attribue' required>";

    $numeroIdentifiant = 1; // Initialiser le compteur

    while ($row = mysqli_fetch_assoc($resultat)) {
        echo "<option value='" . htmlspecialchars($row['id_tic']) . "'>" . $numeroIdentifiant . " - " . htmlspecialchars($row['objet']) . " - Statut actuel : " . htmlspecialchars($row['statut']) . "</option>";
        $numeroIdentifiant++;
    }

    echo "</select>";

    echo "<label for='nouveau_statut'>Nouveau statut :</label>";
    echo "<select id='nouveau_statut' name='nouveau_statut' required>";
    // Vous pouvez remplir cette liste avec les statuts possibles
    echo "<option value='3'>En attente</option>";
    echo "<option value='1'>Ouvert</option>";
    echo "<option value='2'>Fermé</option>";
    echo "</select>";

    echo "<input type='submit' value='Modifier le statut'>";
    echo "</form>";

    mysqli_close($connexion);
}
