<?php
/* Cette page php regroupe les fonctions nécessaires pour les cas d'utilisations de l'administrateur système dont :
 * - La fonction afficherActivitesParType() qui affiche un journal d'activité différent en fonction de celui voulu par l'administrateur
 * */

// ####################################################################################################################
// ####################################################################################################################
// ####################################################################################################################

/* Cette fonction permet d'afficher un journal d'activité de connexion si $type vaut 0 et de tickets si $type vaut 1 */
function afficherActivitesParType($type, $page = 1) {
    echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";
    $connexion = connectDB();

    $limit = 10; // Limite de lignes par page
    $offset = ($page - 1) * $limit;

    $query = "SELECT * FROM journalactivite WHERE type_activite = ? ORDER BY date_activite DESC LIMIT ?, ?";
    $params = ["iii", $type, $offset, $limit];
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

    mysqli_close($connexion);
}


