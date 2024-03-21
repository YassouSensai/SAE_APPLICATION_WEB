<?php

// Chemin vers le fichier de log fail2ban
$filename = '/var/log/fail2ban.log';

// Ouvre le fichier en lecture
$handle = fopen($filename, "r");

if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // Utilise une expression régulière plus précise pour filtrer les lignes
        if (preg_match('/NOTICE\s+[sshd]\s+Ban\s+(\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3})/', $line, $matches)) {
            // Ici, $matches[1] contiendra l'adresse IP qui a été bannie
            // Vous pouvez faire des traitements supplémentaires ici si nécessaire
            echo "Adresse IP bannie : " . $matches[1] . "\n";
        }
    }
    fclose($handle);
} else {
    // Erreur lors de l'ouverture du fichier
    echo "Impossible d'ouvrir le fichier $filename";
}

?>