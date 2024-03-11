<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Log Fail2Ban</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
// Chemin vers le fichier de configuration de Fail2Ban
$configFilePath = '../../../../../etc/fail2ban/jail.conf';

echo($configFilePath);

// Lit le contenu du fichier de configuration
$configContent = file_get_contents($configFilePath);
echo($configContent);

// Utilise une expression régulière pour trouver les adresses IP bannies et leur temps restant
preg_match_all('/^banned = (\S+) \d+; time *= *(\d+)/m', $configContent, $matches);

// Stocke les adresses IP bannies et leur temps restant dans des tableaux associatifs
$bannedIPs = $matches[1];
$remainingTime = $matches[2];

// Affiche les adresses IP bannies dans un tableau avec la date, l'heure et le temps restant
echo "<h2>Adresses IP Bannies :</h2>";
echo "<table>";
echo "<tr><th>Date</th><th>Heure</th><th>Adresse IP</th><th>Temps Restant (en secondes)</th></tr>";

for ($i = 0; $i < count($bannedIPs); $i++) {
    // Récupère la date et l'heure actuelles
    $currentDateTime = date('Y-m-d H:i:s');

    // Calcule la date et l'heure où l'adresse IP a été bannie
    $bannedDateTime = strtotime($currentDateTime) - intval($remainingTime[$i]);

    echo "<tr>";
    // Affiche la date et l'heure de la bannissement
    echo "<td>" . date('Y-m-d', $bannedDateTime) . "</td>";
    echo "<td>" . date('H:i:s', $bannedDateTime) . "</td>";
    // Affiche l'adresse IP bannie
    echo "<td>" . htmlspecialchars($bannedIPs[$i]) . "</td>";
    // Affiche le temps restant (en secondes)
    echo "<td>" . htmlspecialchars($remainingTime[$i]) . "</td>";
    echo "</tr>";
}

echo "</table>";

?>

</body>
</html>