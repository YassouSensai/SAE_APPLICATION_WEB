<?php

function debannirIP($ip, $jail = 'sshd') {
    // Construire la commande pour débannir l'IP
    $command = "sudo /usr/bin/fail2ban-client set $jail unbanip $ip 2>&1";

    // Exécuter la commande
    exec($command, $output, $returnVar);

    // Vérifier si la commande a réussi
    if ($returnVar === 0) {
        echo "L'adresse IP $ip a été débannie avec succès.\n";
    } else {
        echo "Échec du débannissement de l'adresse IP $ip.\n";
    }
    // Chemin complet vers le script save_and_clear_fail2ban_log.sh
    $cheminScript = '/../../save_and_clear_fail2ban_log.sh';

    // Lancer le script save_and_clear_fail2ban_log.sh
    exec("sudo bash $cheminScript", $outputScript, $returnVarScript);

    // Vérifier si le script a été exécuté avec succès
    if ($returnVarScript === 0) {
        echo "Le script save_and_clear_fail2ban_log.sh a été exécuté avec succès.\n";
    } else {
        echo "Échec de l'exécution du script save_and_clear_fail2ban_log.sh.\n";
    }
}

// Exemple d'utilisation de la fonction
debannirIP('192.168.0.88');

?>