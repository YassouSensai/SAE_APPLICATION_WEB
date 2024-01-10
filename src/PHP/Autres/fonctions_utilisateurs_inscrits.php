<?php
include("fonctions_generales.php");
/* Cette page php regroupe les fonctions nécessaires pour les cas d'utilisations des utilisateurs inscrits dont :
 * - La fonction tableau_profil() qui permet d'afficher le profil des utilisateurs
 * - La fonction afficherFormulaireModifierProfil() qui affiche un formulaire afin de modifier son profil
 * - La fonction afficherModifierMotDePasse() qui affiche un formulaire pour modifier son mot de passe
 * - La fonction afficherFormulaireOuvertureTicket() qui affiche un formulaire pour ouvrir un ticket
 * - La fonction afficherTicketsUtilisateurs() qui affiche la liste des tickets de l'utilisateur
 *  */


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

        echo "<form id='formulaireModificationProfil' action='../PagesUtilisateur/Traitement_BD/traitement_modifier_profil.php' method='post'>";

        echo "<label for='nouveau_nom'>Nouveau nom:</label>";
        echo "<input type='text' id='nouveau_nom' name='nouveau_nom' value='" . htmlspecialchars($profilActuel['nom_util']) . "' required><br>";

        echo "<label for='nouveau_prenom'>Nouveau prénom:</label>";
        echo "<input type='text' id='nouveau_prenom' name='nouveau_prenom' value='" . htmlspecialchars($profilActuel['prenom_util']) . "' required><br>";

        echo "<label for='nouvel_email'>Nouvel email:</label>";
        echo "<input type='email' id='nouvel_email' name='nouvel_email' value='" . htmlspecialchars($profilActuel['email_util']) . "' required><br>";

        oeilMdp("mot_de_passe", "mot_de_passe", "mot de passe");


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

    echo "<form action='../PagesUtilisateur/Traitement_BD/traitement_modifier_mdp.php' method='post'>";

    oeilMdp("nouveau_mdp", "nouveau_mdp", "Ancien mot de passe");
    oeilMdp("ancien_mdp", "ancien_mdp", "Nouveau mot de passe");
    oeilMdp("nouveau_mdp2", "nouveau_mdp2", "Nouveau mot de passe");


    captchaForm();

    echo "<input type='submit' value='Modifier'>";
    echo "</form>";
}


// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################



/* Cette fonction permet d'afficher le formulaire d'ouverture de ticket */
function afficherFormulaireOuvertureTicket() {

    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";

    echo "<form action='../PagesUtilisateur/Traitement_BD/traitement_ouverture_ticket.php' method='post'>";

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
