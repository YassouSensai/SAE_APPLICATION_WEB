<?php

// Chemin vers le fichier de log fail2ban
$filename = '/var/log/fail2ban.log';

// Ouvre le fichier en lecture
$handle = fopen($filename, "r");

if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // Utilise une expression régulière pour filtrer les lignes
        if (preg_match('/NOTICE\s+[sshd]\s+Ban\s+\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}/', $line)) {
            echo $line; // Affiche la ligne si elle correspond au motif
        }
    }
    fclose($handle);
} else {
    // Erreur lors de l'ouverture du fichier
    echo "Impossible d'ouvrir le fichier $filename";
}

?>