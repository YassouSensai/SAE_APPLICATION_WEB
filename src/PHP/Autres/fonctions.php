<?php

function tableau_profil($username, $table_user){

    echo "<style>
            table {
                width: auto;
                margin: 20px auto;
                border-collapse: collapse;
            }
            
            th, td {
                border: 3px solid #dddddd;
                text-align: left;
                padding: 8px;
                width: auto;
                max-width: 200px; /* Ajustez la largeur maximale selon vos besoins */
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            
            th {
                text-align: center;
            }

            td:hover {
                background-color: #f5f5f5;
            }

            caption {
                font-size: 1.2em;
                font-weight: bold;
                margin-bottom: 10px;
            }

            
          </style>";

    if ($table_user == 'Utilisateur') {
        echo "<table>
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



    // Informations de connexion à la base de données
    $serveur = "localhost";
    $utilisateur = "user_sae";
    $mot_de_passe = "azerty";
    $base_de_donnees = "sae_bd";

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
        // Fetch the results as an associative array
        $row = mysqli_fetch_assoc($resultat);

        // Supprime le premier élément (Numéro utilisateur)
        array_shift($row);

        // Don't display the password, remove it from the array
        unset($row['mdp']);

        echo "<tr>";
        foreach ($row as $attribut) {
            echo "<td>" . htmlspecialchars($attribut) . "</td>";
        }
        echo "</tr>";
    } else {
        echo "<tr><td colspan='7'>Aucun résultat trouvé</td></tr>";
    }

    echo "</tbody>
        </table>";


    mysqli_close($connexion);
}
?>
