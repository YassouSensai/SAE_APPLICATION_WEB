<?php
require_once '../fonctions_administrateurs_systeme.php'; // Ajustez le chemin selon votre structure de fichiers

// Le reste de votre script...

/* Cette page php regroupe les fonctions nécessaires pour les cas d'utilisations de l'administrateur système dont :
 * - La fonction afficherActivitesParType() qui affiche un journal d'activité différent en fonction de celui voulu par l'administrateur
 * */

// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/**
 * Cette fonction lit un fichier CSV contenant les adresses IP bannies et retourne la liste des adresses IP.
 *
 * @param $cheminCSV : Le chemin vers le fichier CSV à lire.
 * @return array : Un tableau contenant les adresses IP bannies.
 */
function traiterJournal($cheminCSV) {
    if (!file_exists($cheminCSV)) {
        die("Le fichier n'existe pas.");
    }
    $content = file_get_contents($cheminCSV);
    preg_match("/Banned IP list:\s*(.*)/", $content, $matches);
    $bannedIPs = [];
    if (!empty($matches)) {
        $bannedIPs = explode(' ', $matches[1]);
    }
    return $bannedIPs;
}


/**
 * Affiche les adresses IP bannies dans un tableau avec une option pour les débannir.
 *
 * @param array $resultats Un tableau contenant la liste des adresses IP bannies.
 */
function afficherTraiterJournal($resultats) {
    echo "<div style='display: flex;'>";

    echo "<div style='flex: 1;'>";
    echo "<table class='table-fonctions-logs'>";
    echo "<tr><th>Adresses IP bannies</th><th>Action</th></tr>";
    foreach ($resultats as $key => $ip) {
        $class = ($key % 2 == 0) ? 'even' : 'odd';
        echo "<tr class='$class'>";
        echo "<td>$ip</td>";
        // Modification ici : lien direct pour débannir avec méthode GET
        echo "<td><a href='fonction_deban_ip.php?ip=$ip' class='debannir-btn'>Débannir</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

    echo "</div>";
}




/**
 * Cette fonction permet d'afficher un journal d'activité de connexion si $type vaut 1 et de tickets si $type vaut 0
 * Elle affiche également un formulaire pour télécharger le journal d'activité au format CSV
 * @param $type : le type de journal d'activité à afficher et à télécharger
 * @param $page : le numéro de la page du journal d'activité à afficher
 */
function afficherActivitesParType($type, $page = 1) {
    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";
    $connexion = connectDB();

    $limit = 10; // Limite de lignes par page
    $offset = ($page - 1) * $limit;

    $query = "SELECT * FROM journalactivite WHERE type_activite = ? ORDER BY date_activite DESC LIMIT ?, ?";
    $params = ["iii", $type, $offset, $limit];
    $resultat = prepareAndExecute($connexion, $query, $params);

    echo "<table id='table-activites' border='1'>
            <thead>
                <tr>
                    <th>Date d'activité</th>
                    <th>Adresse IP</th>
                    <th>Utilisateur</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>";

    $num = 0;
    while ($row = mysqli_fetch_assoc($resultat)) {
        // Alternance des couleurs des lignes
        $class = ($num % 2 == 0) ? 'even' : 'odd';
        echo "<tr class='$class'>";
        echo "<td>" . htmlspecialchars($row['date_activite']) . "</td>";
        echo "<td>" . htmlspecialchars($row['adresse_ip']) . "</td>";
        echo "<td>" . htmlspecialchars($row['id_utilisateur']) . "</td>";
        echo "<td>" . htmlspecialchars($row['description_activite']) . "</td>";
        echo "</tr>";
        $num++;
    }

    echo "</tbody></table>";

    // Ajouter des boutons pour la navigation entre les pages
    $query_count = "SELECT COUNT(*) AS total FROM journalactivite WHERE type_activite = ?";
    $count_result = prepareAndExecute($connexion, $query_count, ["i", $type]);
    $count_row = mysqli_fetch_assoc($count_result);
    $total_pages = ceil($count_row['total'] / $limit);

    echo "<br><br>";

    if ($total_pages > 1) {
        echo "<div class='journal-navigation'>";
        echo "<ul>";
        if ($page > 1) {
            echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?journal=tickets&page=" . ($page - 1) . "'\">&lt;&lt; Précédent</button></li>";
        }
        if ($page < $total_pages) {
            echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?journal=tickets&page=" . ($page + 1) . "'\">Suivant &gt;&gt;</button></li>";
        }
        echo "</ul>";
        echo "</div>";
    }

    echo '<br>';
    echo '<br>';

    echo '<form action="../Autres/traitements_csv/telecharger_journal_app.php" method="post">';
    echo '<h3>Télécharger un journal au format csv.</h3>';
    echo '<br>';
    echo '<input type="hidden" name="type_journal" value="' . $type . '">';
    echo '<label for="choix_journal">Choisir le type de journal à télécharger :</label>';
    if ($type == 1) {
        echo '<select name="choix_journal" id="choix_journal">';
        echo '<option value="connecté">Journal des Connexions</option>';
        echo '<option value="déconnecté">Journal des Déconnexions</option>';
        echo '</select>';
    } else {
        echo '<select name="choix_journal" id="choix_journal">';
        echo '<option value="créé">Journal des Créations</option>';
        echo '<option value="supprimé">Journal des Suppressions</option>';
        echo '<option value="attribué">Journal des Attributions</option>';
        echo '</select>';
    }
    echo '<br>';
    echo '<br>';
    echo '<button type="submit" name="telecharger_csv">Télécharger</button>';
    echo '</form>';
    mysqli_close($connexion);
}


/**
 * Cette fonction permet de télécharger les fichiers d'un répertoire spécifié.
 * Elle affiche un tableau contenant les fichiers du répertoire avec un lien pour télécharger chaque fichier.
 *
 * Cette fonction sera principalement utilisée pour télécharger les fichiers de logs (cron).
 *
 * @param $cheminRepertoire
 * @return string|void
 */
function telechargerFichiersCron($cheminRepertoire) {
    // Vérifier si le chemin est un répertoire valide
    if (!is_dir($cheminRepertoire)) {
        return "Le chemin spécifié n'est pas un répertoire valide.";
    }

    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";

    // Ouvrir le répertoire
    if ($handle = opendir($cheminRepertoire)) {
        // Début du tableau
        echo "<table border='1'><tr><th>Nom du fichier</th><th>Date de création</th><th>Action</th></tr>";

        // Parcourir chaque fichier dans le répertoire
        while (false !== ($fichier = readdir($handle))) {
            // Ignorer les entrées spéciales
            if ($fichier != "." && $fichier != "..") {
                // Récupérer la date de création du fichier
                $dateCreation = date("Y-m-d H:i:s", filemtime($cheminRepertoire . '/' . $fichier));

                // Vérifier si le fichier est un fichier régulier
                if (is_file($cheminRepertoire . '/' . $fichier)) {
                    // Afficher les informations dans une ligne du tableau
                    echo "<tr>";
                    echo "<td>$fichier</td>";
                    echo "<td>$dateCreation</td>";
                    echo "<td><a href='$cheminRepertoire/$fichier' download>Télécharger</a></td>";
                    echo "</tr>";
                }
            }
        }
        echo "</table>";

        // Fermer le gestionnaire de répertoire
        closedir($handle);
    } else {
        return "Impossible d'ouvrir le répertoire.";
    }
}



?>
