<?php
include("Autres/fonctions_generales.php");

echo "\n\nEtape de départ";
echo "<link rel='stylesheet' href='../CSS/css_fonctions.css'>";

echo "\n\nEtape Connexion";
$connexion = connectDB();

$query = "SELECT t.date_crea_tic, t.objet, u.identifiant AS createur, t.desc_pb_tic, t.adresse_ip, n.libelle_nv_urgence
              FROM Ticket t
              JOIN Utilisateur u ON t.createur_tic = u.identifiant
              JOIN NiveauUrgence n ON t.nv_urgence_tic = n.id_nv_urgence
              ORDER BY t.date_crea_tic DESC";

echo "\n\nEtape execution de la requete";
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


echo "\n\nEtape execution de la requete réussie !!!";
mysqli_close($connexion);
