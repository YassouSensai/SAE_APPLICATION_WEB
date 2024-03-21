<?php
$fail2ban = '/var/log/fail2ban.log';
$content = file_get_contents($fail2ban);
$lines = explode("\n", $content);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Log Fail2Ban</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Fail2Ban Log - Banned IPs</h2>
<table>
    <tr>
        <th>Date et Heure</th>
        <th>IP Bannie</th>
    </tr>
    <?php
    foreach ($lines as $line) {
        // Filtrer pour trouver uniquement les lignes avec une action de bannissement
        if (preg_match('/\bNOTICE\s+[sshd]\s+Ban\s+(\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3})\b/', $line, $matches)) {
            // Capturer la date, l'heure et l'IP bannie
            echo "<tr>";
            echo "<td>".substr($matches[0], 0, 19)."</td>"; // Affiche la date et l'heure
            echo "<td>".$matches[1]."</td>"; // Affiche l'IP bannie
            echo "</tr>";
        }
    }
    ?>
</table>

</body>
</html>