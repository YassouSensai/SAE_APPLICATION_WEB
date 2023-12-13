<?php

// Informations de connexion à la base de données
$serveur = "localhost";
$utilisateur = "user_sae";
$mot_de_passe = "azerty";
$base_de_donnees = "sae_bd";



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


// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Cette fonction permet d'afficher le profil de l'utilisateur qui se connecte. */
function tableau_profil($username, $table_user){

    global $connexion, $serveur, $utilisateur, $mot_de_passe, $base_de_donnees;
    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";

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
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Identifiant</th>
                </tr>
            </thead>
            <tbody>";
    }

    $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

    // Vérification de la connexion
    if (!$connexion) {
        die("La connexion a échoué : ".mysqli_connect_error());
    }

    $query = "SELECT * FROM ".$table_user." WHERE identifiant = ?;";

    $prep = mysqli_prepare($connexion, $query);
    mysqli_stmt_bind_param($prep, 's', $username);
    mysqli_stmt_execute($prep);
    $resultat = mysqli_stmt_get_result($prep);

    if (mysqli_num_rows($resultat) > 0) {
        $row = mysqli_fetch_assoc($resultat);

        // Supprime le premier élément (Numéro utilisateur)
        array_shift($row);

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

    global $connexion, $serveur, $utilisateur, $mot_de_passe, $base_de_donnees;
    $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

    // Vérification de la connexion
    if (!$connexion) {
        die("La connexion a échoué : ".mysqli_connect_error());
    }

    $query = "SELECT * FROM ".$table_user." WHERE identifiant = ?;";

    $prep = mysqli_prepare($connexion, $query);
    mysqli_stmt_bind_param($prep, 's', $username);
    mysqli_stmt_execute($prep);
    $resultat = mysqli_stmt_get_result($prep);

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

    echo "<label for='description_ticket'>Description du problème :</label>";
    echo "<textarea id='description_ticket' name='description_ticket'  placeholder='Description ...' required></textarea><br>";

    echo "<label for='mdp'>Entrez votre mot de passe</label>";
    echo "<input type='password' id='mdp' name='mdp' placeholder='Votre mot de passe' required><br>";


    echo "<input type='submit' value='Ouvrir le ticket'>";
    echo "</form>";
}



?>



