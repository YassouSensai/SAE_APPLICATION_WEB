<?php
$fail2banLogPath = '/var/log/fail2ban.log';
$lines = file($fail2banLogPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fail2Ban Log - Bans and Restores</title>
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

<h2>Fail2Ban Log - Bans and Restores</h2>
<table>
    <tr>
        <th>Date and Time</th>
        <th>Action</th>
        <th>IP Address</th>
    </tr>
    <?php
    foreach ($lines as $line) {
        if (preg_match('/(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}),\d+\s+fail2ban.actions\s+[\d+]:\s+NOTICE\s+[sshd]\s+(Ban|Restore Ban)\s+(\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3})/', $line, $matches)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($matches[1]) . "</td>"; // Date and Time
            echo "<td>" . htmlspecialchars($matches[2]) . "</td>"; // Action
            echo "<td>" . htmlspecialchars($matches[3]) . "</td>"; // IP Address
            echo "</tr>";
        }
    }
    ?>
</table>

</body>
</html>