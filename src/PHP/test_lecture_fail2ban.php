<?php

// La chaîne de caractères à analyser
$log = "2024-03-20 14:00:00,000 fail2ban.server         [1234]: INFO    Starting Fail2ban v0.10.4
2024-03-20 14:00:00,001 fail2ban.database       [1234]: INFO    Connected to fail2ban persistent database '/var/lib/fail2ban/fail2ban.sqlite3'
2024-03-20 14:00:00,002 fail2ban.jail           [1234]: INFO    Creating new jail 'sshd'
2024-03-20 14:00:00,003 fail2ban.jail           [1234]: INFO    Jail 'sshd' started
2024-03-20 14:16:53,158 fail2ban.actions        [2631]: NOTICE  [sshd] Ban 192.168.0.219
2024-03-20 14:19:25,848 fail2ban.actions        [2688]: NOTICE  [sshd] Unban 192.168.0.219
2024-03-20 14:23:08,432 fail2ban.actions        [2957]: NOTICE  [sshd] Ban 192.168.1.42
2024-03-20 14:50:00,000 fail2ban.actions        [3000]: NOTICE  [sshd] Unban 192.199.199.199
2024-03-20 14:51:40,908 fail2ban.jail           [3000]: INFO    Jail 'sshd' stopped
2024-03-20 14:52:00,000 fail2ban.server         [1234]: INFO    Exiting Fail2ban";

// Initialiser les listes pour les adresses IP bannies et débannies
$banList = [];
$unbanList = [];

// Diviser le journal en lignes
$lines = explode("\n", $log);

foreach ($lines as $line) {
    // Rechercher des actions de ban
    if (preg_match('/Ban (\d+\.\d+\.\d+\.\d+)/', $line, $matches)) {
        $banList[] = $matches[1];
    }
    // Rechercher des actions de unban
    elseif (preg_match('/Unban (\d+\.\d+\.\d+\.\d+)/', $line, $matches)) {
        $unbanList[] = $matches[1];
    }
}

// Afficher les listes
echo "Adresses IP bannies :\n";
foreach ($banList as $ip) {
    echo "- $ip\n";
}
echo '<br>';

echo "\nAdresses IP débannies :\n";
foreach ($unbanList as $ip) {
    echo "- $ip\n";
}

?>
