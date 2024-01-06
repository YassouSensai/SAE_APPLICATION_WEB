<?php
function connectDB() {
    $serveur = "localhost";
    $utilisateur = "user_sae";
    $mot_de_passe = "azerty";
    $base_de_donnees = "sae_bd";

    $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

    if (!$connexion) {
        die("La connexion a échoué : " . mysqli_connect_error());
    }

    return $connexion;
}

function prepareAndExecute($connexion, $query, $params = null) {
    $prep = mysqli_prepare($connexion, $query);

    if (!$prep) {
        die("La préparation de la requête a échoué : " . mysqli_error($connexion));
    }

    if ($params) {
        mysqli_stmt_bind_param($prep, ...$params);
    }

    mysqli_stmt_execute($prep);

    return mysqli_stmt_get_result($prep);
}

function logActivity($username, $type, $description) {
    $connexion = connectDB();

    $query = "INSERT INTO JournalActivite (date_activite, adresse_ip, id_utilisateur, type_activite, description_activite) VALUES (NOW(), ?, ?, ?, ?)";
    $params = ["ssis", $_SERVER['REMOTE_ADDR'], $username, $type, $description];
    prepareAndExecute($connexion, $query, $params);

    mysqli_close($connexion);
}



// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Cette fonction permet d'afficher le profil de l'utilisateur qui se connecte. */
function tableau_profil($username, $table_user) {

    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";
    $connexion = connectDB();

    if ($table_user == 'Utilisateur') {
        echo "<table id='table-utilisateur'>
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>";
    } else {
        echo "<table>
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                </tr>
            </thead>
            <tbody>";
    }


    $query = "SELECT * FROM ".$table_user." WHERE identifiant = ?;";
    $params = ["s", $username];
    $resultat = prepareAndExecute($connexion, $query, $params);

    if (mysqli_num_rows($resultat) > 0) {
        $row = mysqli_fetch_assoc($resultat);

        // Don't display the password, remove it from the array
        unset($row['mdp']);

        echo "<tr>";
        foreach ($row as $attribut) {
            echo "<td id='cell'>" . htmlspecialchars($attribut) . "</td>";
        }
        echo "</tr>";
    } else {
        echo "<tr><td colspan='7'>Aucun résultat trouvé</td></tr>";
    }

    echo "</tbody>
        </table>";

    mysqli_close($connexion);
}


// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################


/* Cette fonction permet d'afficher le formulaire de modification de profil */
function afficherFormulaireModifierProfil($username, $table_user) {

    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";
    $connexion = connectDB();

    $query = "SELECT * FROM ".$table_user." WHERE identifiant = ?;";
    $params = ["s", $username];
    $resultat = prepareAndExecute($connexion, $query, $params);


    if (mysqli_num_rows($resultat) > 0) {
        $profilActuel = mysqli_fetch_assoc($resultat);

        echo "<form id='formulaireModificationProfil' action='../PagesUtilisateur/traitement_modifier_profil.php' method='post'>";

        echo "<label for='nouveau_nom'>Nouveau nom:</label>";
        echo "<input type='text' id='nouveau_nom' name='nouveau_nom' value='" . htmlspecialchars($profilActuel['nom_util']) . "' required><br>";

        echo "<label for='nouveau_prenom'>Nouveau prénom:</label>";
        echo "<input type='text' id='nouveau_prenom' name='nouveau_prenom' value='" . htmlspecialchars($profilActuel['prenom_util']) . "' required><br>";

        echo "<label for='nouvel_email'>Nouvel email:</label>";
        echo "<input type='email' id='nouvel_email' name='nouvel_email' value='" . htmlspecialchars($profilActuel['email_util']) . "' required><br>";

        echo "<label for='mot_de_passe'>Votre mot-de-passe:</label>";
        echo "<input type='password' id='mot_de_passe' name='mot_de_passe' placeholder='mot-de-passe' required><br>";


        echo "<input type='submit' value='Modifier'>";
        echo "</form>";
    } else {
        echo "Utilisateur non trouvé.";
    }

    // Fermer la requête et la connexion
    mysqli_close($connexion);
}

// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Cette fonction permet d'afficher le formulaire de modification de mot de passe */
function afficherModifierMotDePasse() {
    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";

    echo "<form action='../PagesUtilisateur/traitement_modifier_mdp.php' method='post'>";

    echo "<label for='ancien_mdp'>Votre ancien mot de passe :</label>";
    echo "<input type='password' id='ancien_mdp' name='ancien_mdp' placeholder='Ancien mot de passe' required><br>";

    echo "<label for='nouveau_mdp'>Votre nouveau mot de passe :</label>";
    echo "<input type='password' id='nouveau_mdp' name='nouveau_mdp' placeholder='Nouveau mot de passe' required><br>";

    echo "<label for='nouveau_mdp2'>Validez votre mot de passe :</label>";
    echo "<input type='password' id='nouveau_mdp2' name='nouveau_mdp2' placeholder='Nouveau mot de passe' required><br>";

    $nb1 = rand(1, 10);
    $nb2 = rand(1, 20);

    $_SESSION['nb1'] = $nb1;
    $_SESSION['nb2'] = $nb2;

    echo "<label for='captcha'>Captcha : " . $nb1 . " x " . $nb2 . " = ? (requis)</label>";
    echo "<input id='captcha' type='number' name='captcha' placeholder='Résultat' required>";


    echo "<input type='submit' value='Modifier'>";
    echo "</form>";
}


// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################



/* Cette fonction permet d'afficher le formulaire d'ouverture de ticket */
function afficherFormulaireOuvertureTicket() {

    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";

    echo "<form action='traitement_ouverture_ticket.php' method='post'>";

    echo "<label for='sujet_ticket'>Sujet du ticket :</label>";
    echo "<input type='text' id='sujet_ticket' name='sujet_ticket' placeholder='sujet ...' required><br>";


    echo "<label for='niveau_urgence'>Sur une échelle de 1 à 4, quel est le niveau d'urgence :</label>";
    echo "<select id='niveau_urgence' type='number' name='niveau_urgence' required>
              <option value='1'>1</option>
              <option value='2'>2</option>
              <option value='3'>3</option>
              <option value='4'>4</option>
              </select>";

    echo "<label for='salle'>Dans quelle salle le problème se situe ?</label>";
    echo "<select id='salle' type='text' name='salle' required>
              <option value='I21'>I21</option>
              <option value='G21'>G21</option>
              <option value='G22'>G22</option>
              <option value='G23'>G23</option>
              <option value='G24'>G24</option>
              <option value='G25'>G25</option>
              </select>";

    echo "<label for='description_ticket'>Description du problème :</label>";
    echo "<textarea id='description_ticket' name='description_ticket'  placeholder='Description ...' required></textarea><br>";

    echo "<label for='mdp'>Entrez votre mot de passe</label>";
    echo "<input type='password' id='mdp' name='mdp' placeholder='Votre mot de passe' required><br>";


    echo "<input type='submit' value='Ouvrir le ticket'>";
    echo "</form>";
}




// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Cette fonction affiche les tickets des utilisateurs.
 * Pour les utilisateurs inscrit : Tous les tickets qu'ils ont créés
 * Pour les techniciens : Tous les tickets qu'ils prennent en charge
 *
 * */
function afficherTicketsUtilisateurs($username, $table_user) {

    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";
    $connexion = connectDB();

    $query = "";

    if ($table_user == 'Utilisateur') {

        $query = "SELECT t.date_crea_tic, t.objet, t.desc_pb_tic, t.adresse_ip, t.salle, s.libelle_statut_tic AS statut, u.libelle_nv_urgence AS urgence
              FROM Ticket t
              JOIN StatutTicket s ON t.status_tic = s.id_statut_tic
              JOIN NiveauUrgence u ON t.nv_urgence_tic = u.id_nv_urgence
              WHERE t.createur_tic = ?
              ORDER BY t.date_crea_tic DESC";

    } elseif ($table_user == 'Technicien') {

        $query = "SELECT t.date_crea_tic, t.objet, t.desc_pb_tic, t.adresse_ip, t.salle, s.libelle_statut_tic AS statut, u.libelle_nv_urgence AS urgence
              FROM Ticket t
              JOIN StatutTicket s ON t.status_tic = s.id_statut_tic
              JOIN NiveauUrgence u ON t.nv_urgence_tic = u.id_nv_urgence
              WHERE t.tech_charge_tic = ?
              ORDER BY t.date_crea_tic DESC";
    }

    $params = ["s", $username];
    $resultat = prepareAndExecute($connexion, $query, $params);

    echo "<table id='table-mes-tickets'>
            <thead>
                <tr>
                    <th>Ticket</th>
                    <th>Date de création</th>
                    <th>Objet</th>
                    <th>Description</th>
                    <th>Adresse IP</th>
                    <th>Salle</th>
                    <th>Statut</th>
                    <th>Niveau d'urgence</th>
                </tr>
            </thead>
            <tbody>";

    $num = 0;
    while ($row = mysqli_fetch_assoc($resultat)) {
        $num = $num + 1;
        echo "<tr>";
        echo "<td>" . $num . "</td>";
        echo "<td>" . htmlspecialchars($row['date_crea_tic']) . "</td>";
        echo "<td>" . htmlspecialchars($row['objet']) . "</td>";
        echo "<td>" . htmlspecialchars($row['desc_pb_tic']) . "</td>";
        echo "<td>" . htmlspecialchars($row['adresse_ip']) . "</td>";
        echo "<td>" . htmlspecialchars($row['salle']) . "</td>";
        echo "<td>" . htmlspecialchars($row['statut']) . "</td>";
        echo "<td>" . htmlspecialchars($row['urgence']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody>
        </table>";

    mysqli_close($connexion);
}


// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Fonction qui permet d'afficher les tickets que l'on peut s'attribuer en tant que technicien */
function afficherFormChoixTicketsNonAttribues() {
    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";
    $connexion = connectDB();

    $query = "SELECT id_tic, objet, date_crea_tic FROM Ticket WHERE tech_charge_tic IS NULL ORDER BY date_crea_tic DESC";
    $resultat = prepareAndExecute($connexion, $query);

    echo "<form action='traitement_attribuer_ticket.php' method='post'>";
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

    echo "<form action='traitement_modifier_statut_ticket.php' method='post'>";
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



// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Cette fonction permet d'afficher un journal d'activité de connexion si $type vaut 0 et de tickets si $type vaut 1 */
function afficherActivitesParType($type) {

    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";
    $connexion = connectDB();

    $query = "SELECT * FROM JournalActivite WHERE type_activite = ? ORDER BY date_activite DESC";
    $params = ["i", $type];
    $resultat = prepareAndExecute($connexion, $query, $params);

    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Date d'activité</th>
                    <th>Adresse IP</th>
                    <th>Utilisateur</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = mysqli_fetch_assoc($resultat)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['date_activite']) . "</td>";
        echo "<td>" . htmlspecialchars($row['adresse_ip']) . "</td>";
        echo "<td>" . htmlspecialchars($row['id_utilisateur']) . "</td>";
        echo "<td>" . htmlspecialchars($row['description_activite']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";

    mysqli_close($connexion);
}



// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Cette fonction affiche absolument tous les tickets avec toutes les informations necessaires pour l'administrateur web*/
function afficherTicketsAvecDetails() {

    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";
    $connexion = connectDB();

    $query = "SELECT t.date_crea_tic, t.objet, u.identifiant AS createur, t.desc_pb_tic, t.adresse_ip, n.libelle_nv_urgence
              FROM Ticket t
              JOIN Utilisateur u ON t.createur_tic = u.identifiant
              JOIN NiveauUrgence n ON t.nv_urgence_tic = n.id_nv_urgence
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

    $query = "SELECT identifiant FROM Utilisateur";
    $resultatUtilisateur = prepareAndExecute($connexion, $query);

    $query = "SELECT identifiant FROM Technicien";
    $resultatTechnicien = prepareAndExecute($connexion, $query);

    $query = "SELECT identifiant FROM AdminSysteme";
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

    echo "<form action='traitement_inscription_technicien.php' method='post'>";
    echo "<h3>Inscription d'un nouveau technicien</h3>";
    echo "<br>";
    echo "<label for='identifiant'>Identifiant :</label>";
    echo "<input type='text' id='identifiant' name='identifiant' placeholder='Identifiant du technicien' required>";

    echo "<label for='mdp'>Mot de passe :</label>";
    echo "<input type='password' id='mdp' name='mdp' placeholder='Mot de passe du technicien' required>";

    echo "<label for='Technicien'>Type d'utilisateur :</label>";
    echo "<input type='text' id='Technicien' name='Technicien' value='Technicien' readonly>";

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
    $queryTickets = "SELECT id_tic, objet, date_crea_tic FROM Ticket WHERE tech_charge_tic IS NULL ORDER BY date_crea_tic DESC";
    $resultatTickets = prepareAndExecute($connexion, $queryTickets);

    // Sélectionner les techniciens avec le nombre de tickets actuels
    $queryTechniciens = "SELECT t.identifiant, COUNT(t2.id_tic) AS nb_tickets
                         FROM Technicien t
                         LEFT JOIN Ticket t2 ON t.identifiant = t2.tech_charge_tic
                         GROUP BY t.identifiant";
    $resultatTechniciens = prepareAndExecute($connexion, $queryTechniciens);

    echo "<form action='traitement_attribution_ticket.php' method='post'>";

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
    $queryTickets = "SELECT id_tic, objet, date_crea_tic FROM Ticket ORDER BY date_crea_tic DESC";
    $resultatTickets = prepareAndExecute($connexion, $queryTickets);

    echo "<form action='traitement_suppression_ticket.php' method='post'>";
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


?>