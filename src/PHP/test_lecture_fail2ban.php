<?php

function processFail2BanLog($logContent) {
    $lines = explode("\n", $logContent);
    $bannedIPs = [];
    $unbannedIPs = [];

    foreach ($lines as $line) {
        if (preg_match('/NOTICE\s+\[sshd\]\s+Ban\s+(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $line, $matches)) {
            $bannedIPs[$matches[1]] = true;
        }

        if (preg_match('/NOTICE\s+\[sshd\]\s+Unban\s+(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $line, $matches)) {
            $unbannedIPs[$matches[1]] = true;
        }
    }

    foreach ($unbannedIPs as $ip => $_) {
        if (isset($bannedIPs[$ip])) {
            unset($bannedIPs[$ip]);
        }
    }

    return array_keys($bannedIPs);
}

$logContent = <<<EOL
2024-03-20 14:00:00,000 fail2ban.server         [1234]: INFO    Starting Fail2ban v0.10.4
2024-03-20 14:00:00,001 fail2ban.database       [1234]: INFO    Connected to fail2ban persistent database '/var/lib/fail2ban/fail2ban.sqlite3'
2024-03-20 14:00:00,002 fail2ban.jail           [1234]: INFO    Creating new jail 'sshd'
2024-03-20 14:00:00,003 fail2ban.jail           [1234]: INFO    Jail 'sshd' started
2024-03-20 14:16:53,158 fail2ban.actions        [2631]: NOTICE  [sshd] Ban 192.168.0.219
2024-03-20 14:19:25,848 fail2ban.actions        [2688]: NOTICE  [sshd] Unban 192.168.0.219
2024-03-20 14:23:08,432 fail2ban.actions        [2957]: NOTICE  [sshd] Ban 192.168.1.42
2024-03-20 14:50:00,000 fail2ban.actions        [3000]: NOTICE  [sshd] Unban 192.168.1.42
2024-03-20 14:51:40,908 fail2ban.jail           [3000]: INFO    Jail 'sshd' stopped
2024-03-20 14:52:00,000 fail2ban.server         [1234]: INFO    Exiting Fail2ban
EOL;

// Affichage du contenu de $logContent pour déboguer
echo "<p>" . nl2br($logContent) . "</p>";

// Traitement du log
$bannedIPs = processFail2BanLog($logContent);

echo "Adresses IP finalement bannies:<br>";
print_r($bannedIPs);
