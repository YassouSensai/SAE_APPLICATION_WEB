<?php

// Exemple d'adresse IP à débannir
// Supposons que $ips soit un tableau contenant les adresses IP à débannir
$ips = ['192.168.0.88'];

// Jail à partir duquel les IPs doivent être débannies, par exemple 'sshd'
$jail = 'sshd';

foreach ($ips as $ip) {
    // Commande pour débannir l'IP
    $command = "sudo fail2ban-client set $jail unbanip $ip";

    // Exécuter la commande
    exec($command, $output, $returnVar);

    // Vérifier si la commande a réussi
    if ($returnVar === 0) {
        echo "L'adresse IP $ip a été débannie avec succès.\n";
    } else {
        echo "Échec du débannissement de l'adresse IP $ip.\n";
    }
}

?>