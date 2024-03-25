<?php
/* Cette page php regroupe les fonctions nécessaires pour les cas d'utilisations de l'administrateur système dont :
 * - La fonction afficherActivitesParType() qui affiche un journal d'activité différent en fonction de celui voulu par l'administrateur
 * */

// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################
/**
 * Débannir une adresse IP.
 *
 * @param string $ip L'adresse IP à débannir.
 * @param string $jail Le jail Fail2ban concerné. Par défaut, 'sshd'.
 * @return bool True si l'adresse IP est débannie avec succès, sinon False.
 */
function debannirIP($ip, $jail = 'sshd') {
    $bannedIPs = getBannedIPs($jail);
    if (!in_array($ip, $bannedIPs)) {
        enregistrerLog("L'adresse IP $ip n'est pas actuellement bannie du jail $jail.");
        return false;
    }

    $command = "sudo /usr/bin/fail2ban-client set $jail unbanip $ip 2>&1";
    exec($command, $output, $returnVar);

    if ($returnVar === 0) {
        enregistrerLog("L'adresse IP $ip a été débannie du jail $jail.");
        return true;
    } else {
        enregistrerLog("Échec du débannissement de l'adresse IP $ip du jail $jail.");
        return false;
    }
}

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
        echo "<td><a href='#' onclick='debanirIP(\"$ip\");'><img src='../../images/poubelles.svg' alt='Débannir' width='20' height='20' /></a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

    echo "</div>";

    // Ajout du script JavaScript pour débannir l'IP
    echo "<script>
            function debanirIP(ip) {
                if (confirm('Êtes-vous sûr de vouloir débannir cette adresse IP ?')) {
                    fetch('../fonctions_administrateur_systeme/debannir.php?ip=' + ip)
                        .then(response => {
                            if (response.ok) {
                                // Actualiser la page pour refléter les changements
                                location.reload();
                            } else {
                                alert('Une erreur est survenue lors du débannissement de l\'adresse IP.');
                            }
                        })
                        .catch(error => {
                            console.error('Erreur lors de la demande de débannissement :', error);
                            alert('Une erreur est survenue lors du débannissement de l\'adresse IP.');
                        });
                }
            }
          </script>";
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



?>
