<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tickets</title>
    <link rel="stylesheet" href="../CSS/css_fonctions.css">
</head>
<body>
<?php
include("Autres/fonctions_generales.php");

echo "<br><br><h1>Liste des Tickets</h1>";

// Etape Connexion
echo "<br><br><strong>Etape Connexion</strong>";
$connexion = connectDB();

$query = "SELECT objet FROM ticket ORDER BY date_crea_tic DESC";
$resultat = mysqli_query($connexion, $query);

if ($resultat) {
    echo "<table border='1'>
                <thead>
                    <tr>
                        <th>Nom du ticket</th>
                    </tr>
                </thead>
                <tbody>";

    while ($row = mysqli_fetch_assoc($resultat)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['objet']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";

    echo "<br><br><p><strong>Etape execution de la requete réussie !!!</strong></p>";
} else {
    echo "<br><br><p>Erreur lors de l'exécution de la requête.</p>";
}

mysqli_close($connexion);
?>
</body>
</html>
