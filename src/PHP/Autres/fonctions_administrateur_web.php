<?php

/* Cette page php regroupe les fonctions nécessaires pour les cas d'utilisations de l'administrateur web dont :
 * - La fonction afficherTicketsAvecDetails() qui affiche tous les tickets avec les details nécessaires
 * - La fonction afficherUtilisateurs() qui affiche tous les utilisateurs dont le staff
 * - La fonction afficherFormulaireInscriptionTechnicien() qui affiche un formulaire afin d'inscrire un nouveau technicien
 * - La fonction afficherFormulaireAttributionTicket() qui affiche un formulaire pour attribuer un ticket à un technicien
 * - La fonction afficherFormulaireSuppressionTicket() qui affiche un formulaire pour supprimer un ticket
 * */

include("fonctions_generales.php");

// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Cette fonction affiche absolument tous les tickets avec toutes les informations necessaires pour l'administrateur web*/
function afficherTicketsAvecDetails() {

    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";
    $connexion = connectDB();

    $query = "SELECT t.date_crea_tic, t.objet, u.identifiant AS createur, t.desc_pb_tic, t.adresse_ip, n.libelle_nv_urgence
              FROM ticket t
              JOIN utilisateur u ON t.createur_tic = u.identifiant
              JOIN niveauurgence n ON t.nv_urgence_tic = n.id_nv_urgence
              ORDER BY t.date_crea_tic DESC";

    $resultat = prepareAndExecute($connexion, $query);

    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Date de création</th>
                    <th>Objet</th>
                    <th>Information</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = mysqli_fetch_assoc($resultat)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['date_crea_tic']) . "</td>";
        echo "<td>" . htmlspecialchars($row['objet']) . "</td>";

        // Construction dynamique du paragraphe d'information
        $infoParagraph = "Créé le " . htmlspecialchars($row['date_crea_tic']) . " par l'utilisateur " . htmlspecialchars($row['createur']);
        $infoParagraph .= " depuis l'adresse IP " . htmlspecialchars($row['adresse_ip']) . ". Urgence : " . htmlspecialchars($row['libelle_nv_urgence']);
        $infoParagraph .= "<br><br><strong>Problème :</strong> " . htmlspecialchars($row['desc_pb_tic']);

        echo "<td>" . $infoParagraph . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";

    mysqli_close($connexion);
}



// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Cette fonction permet d'afficher tous les utilisateurs, techniciens et administrateurs syteme pour l'administrateur web */
function afficherUtilisateurs() {

    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";
    $connexion = connectDB();

    $query = "SELECT identifiant FROM utilisateur";
    $resultatUtilisateur = prepareAndExecute($connexion, $query);

    $query = "SELECT identifiant FROM technicien";
    $resultatTechnicien = prepareAndExecute($connexion, $query);

    $query = "SELECT identifiant FROM adminsysteme";
    $resultatAdminSysteme = prepareAndExecute($connexion, $query);

    echo "<table>
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Type d'utilisateur</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = mysqli_fetch_assoc($resultatUtilisateur)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['identifiant']) . "</td>";
        echo "<td>Utilisateur</td>";
        echo "</tr>";
    }

    while ($row = mysqli_fetch_assoc($resultatTechnicien)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['identifiant']) . "</td>";
        echo "<td>Technicien</td>";
        echo "</tr>";
    }

    while ($row = mysqli_fetch_assoc($resultatAdminSysteme)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['identifiant']) . "</td>";
        echo "<td>Administrateur Système</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";

    mysqli_close($connexion);
}


// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Cette fonction permet à l'administrateur web d'inscrire un nouveau technicien*/
function afficherFormulaireInscriptionTechnicien() {

    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";

    echo "<form action='Traitement_BD/traitement_inscription_technicien.php' method='post'>";
    echo "<h3>Inscription d'un nouveau technicien</h3>";
    echo "<br>";
    echo "<label for='identifiant'>Identifiant :</label>";
    echo "<input type='text' id='identifiant' name='identifiant' placeholder='Identifiant du technicien' required>";

    oeilMdp('mdp', 'mdp', 'mdp','Mot de passe du technicien');

    echo "<label for='nom_tech'>Nom du technicien :</label>";
    echo "<input type='text' id='nom_tech' name='nom_tech' placeholder='Nom du technicien' required>";

    echo "<label for='prenom_tech'>Prenom du technicien :</label>";
    echo "<input type='text' id='prenom_tech' name='prenom_tech' placeholder='Prenom du technicien' required>";

    echo "<input type='submit' value='Inscrire le technicien'>";
    echo "</form>";
}


// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Cette fonction permet à l'administrateur web d'attribuer un ticket à un technicien*/
function afficherFormulaireAttributionTicket() {

    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";

    $connexion = connectDB();

    // Sélectionner les tickets non attribués
    $queryTickets = "SELECT id_tic, objet, date_crea_tic FROM ticket WHERE tech_charge_tic IS NULL ORDER BY date_crea_tic DESC";
    $resultatTickets = prepareAndExecute($connexion, $queryTickets);

    // Sélectionner les techniciens avec le nombre de tickets actuels
    $queryTechniciens = "SELECT t.identifiant, COUNT(t2.id_tic) AS nb_tickets
                         FROM technicien t
                         LEFT JOIN Ticket t2 ON t.identifiant = t2.tech_charge_tic
                         GROUP BY t.identifiant";
    $resultatTechniciens = prepareAndExecute($connexion, $queryTechniciens);

    echo "<form action='Traitement_BD/traitement_attribution_ticket_admin_to_tech.php' method='post'>";
    echo "<h3>Attribuer un ticket à un technicien</h3>";
    echo "<br>";
    echo "<label for='ticket_libre'>Choisir un ticket libre :</label>";
    echo "<select id='ticket_libre' name='ticket_libre' required>";

    $compteur = 1;

    while ($row = mysqli_fetch_assoc($resultatTickets)) {
        $dateCreation = date('d/m/Y', strtotime($row['date_crea_tic']));
        echo "<option value='" . htmlspecialchars($compteur) . "'>" . $compteur . " - " . htmlspecialchars($row['objet']) . " - " . $dateCreation . "</option>";
        $compteur++;
    }

    echo "</select>";

    echo "<label for='technicien_attribue'>Choisir un technicien :</label>";
    echo "<select id='technicien_attribue' name='technicien_attribue' required>";

    while ($rowTechnicien = mysqli_fetch_assoc($resultatTechniciens)) {
        echo "<option value='" . htmlspecialchars($rowTechnicien['identifiant']) . "'>" . htmlspecialchars($rowTechnicien['identifiant']) . " (Tickets actuels : " . htmlspecialchars($rowTechnicien['nb_tickets']) . ")</option>";
    }

    echo "</select>";

    echo "<input type='submit' value='Attribuer le ticket'>";
    echo "</form>";

    mysqli_close($connexion);
}



// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Cette fonction permet à l'administrateur web de choisir un ticket et de le supprimer*/
function afficherFormulaireSuppressionTicket() {
    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";

    $connexion = connectDB();

    // Sélectionner tous les tickets
    $queryTickets = "SELECT id_tic, objet, date_crea_tic FROM ticket ORDER BY date_crea_tic DESC";
    $resultatTickets = prepareAndExecute($connexion, $queryTickets);

    echo "<form action='Traitement_BD/traitement_suppression_ticket.php' method='post'>";
    echo "<h3>Supprimer un ticket</h3>";
    echo "<br>";
    echo "<label for='ticket_supprimer'>Choisir un ticket à supprimer :</label>";
    echo "<select id='ticket_supprimer' name='ticket_supprimer' required>";

    while ($row = mysqli_fetch_assoc($resultatTickets)) {
        $dateCreation = date('d/m/Y', strtotime($row['date_crea_tic']));
        echo "<option value='" . htmlspecialchars($row['id_tic']) . "'>" . htmlspecialchars($row['objet']) . " - " . $dateCreation . "</option>";
    }

    echo "</select>";
    echo "<input type='submit' value='Supprimer le ticket'>";
    echo "</form>";

    mysqli_close($connexion);
}
