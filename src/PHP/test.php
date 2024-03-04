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
// Chemin vers le fichier log de Fail2Ban
$logFilePath = '/var/log/fail2ban.log';

// Lit le fichier log et stocke le contenu dans une variable
$logContent = file_get_contents($logFilePath);

// Divise le log en sections basées sur un motif spécifique (chaque démarrage de Fail2Ban)
$sections = preg_split('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2},\d{3} fail2ban.server\s+[\d+]: INFO\s+--------------------------------------------------/', $logContent);

// Détermine la section actuelle à afficher
$currentSection = isset($_GET['section']) ? intval($_GET['section']) : 0;
$currentSection = max(0, min($currentSection, count($sections) - 1));

// Affiche la section actuelle du log dans un tableau HTML
$lines = explode("\n", $sections[$currentSection]);

echo "<table>";
echo "<tr><th>Date et Heure</th><th>Processus</th><th>Action</th><th>IP/Info</th></tr>";

foreach ($lines as $line) {
    if (preg_match('/(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2},\d{3}) (fail2ban\.[\w+]+\s+\[[\d+]\]): (\w+)\s+\[(\w+)\] (.+)/', $line, $matches)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($matches[1]) . "</td>";
        echo "<td>" . htmlspecialchars($matches[2]) . "</td>";
        echo "<td>" . htmlspecialchars($matches[3]) . "</td>";
        echo "<td>" . htmlspecialchars($matches[5]) . "</td>";
        echo "</tr>";
    }
}

echo "</table>";

// Boutons de navigation
if ($currentSection > 0) {
    echo '<a href="?section=' . ($currentSection - 1) . '">Section Précédente</a> | ';
}
if ($currentSection < count($sections) - 1) {
    echo '<a href="?section=' . ($currentSection + 1) . '">Section Suivante</a>';
}
?>

</body>
</html>