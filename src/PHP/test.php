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

<h2>Fail2Ban Log</h2>
<table>
    <tr>
        <th>Date et Heure</th>
        <th>Message</th>
    </tr>
    <?php
    foreach ($lines as $line) {
        if (!empty($line)) {
            // Modifier l'expression régulière selon le format exact de votre fichier log
            if (preg_match('/^(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}),\d+ (.+)$/', $line, $matches)) {
                $dateTime = $matches[1];
                $message = $matches[2];
                echo "<tr>";
                echo "<td>$dateTime</td>";
                echo "<td>$message</td>";
                echo "</tr>";
            }
        }
    }
    ?>
</table>

<?php
$file = '/var/log/apache2/access.log';
$content = file_get_contents($file);
if ($content === false) {
    echo "Impossible de lire le fichier";
} else {
    echo "<pre>$content</pre>";
}
?>


</body>
</html>

