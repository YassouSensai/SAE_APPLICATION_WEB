<?php
if (isset($_GET['ip'])) {
    $ip = $_GET['ip'];
} else {
    echo "<script>alert('Erreur : Aucune adresse IP fournie.');</script>";
    exit; // Quitte le script si aucune adresse IP n'est fournie
}

function debannirIP($ip, $jail = 'sshd') {
    // Exécuter la commande pour débannir l'IP
    $command = "sudo /usr/bin/fail2ban-client set $jail unbanip $ip 2>&1";
    exec($command, $output, $returnVar);

    if ($returnVar === 0) {
        echo "<script>alert('L\'adresse IP $ip a été débannie avec succès.');</script>";
    } else {
        echo "<script>alert('Échec du débannissement de l\'adresse IP $ip.');</script>";
    }

    // Chemin vers le répertoire CSV
    $destDir = __DIR__ . '/csv';

    // Trouver le fichier CSV le plus récent qui commence par 'ip_banned'
    $latestCsvFile = '';
    $files = glob($destDir . '/ip_banned_*.csv');
    if ($files) {
        usort($files, function($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        $latestCsvFile = $files[0]; // Prendre le fichier le plus récent
    }

    // Si aucun fichier n'est trouvé, créer un nouveau nom de fichier
    if (empty($latestCsvFile)) {
        $date = new DateTime();
        $latestCsvFile = $destDir . '/ip_banned_' . $date->format('Y-m-d_H-i-s') . '.csv';
    }

    // Obtenir le statut actuel de sshd et stocker dans le fichier CSV
    $statusCommand = "sudo /usr/bin/fail2ban-client status $jail 2>&1";
    $statusOutput = shell_exec($statusCommand);

    // Écrire le résultat dans le fichier CSV, en écrasant le contenu existant
    file_put_contents($latestCsvFile, $statusOutput);

    if (file_exists($latestCsvFile)) {
        echo "<script>alert('Le fichier CSV a été mis à jour avec succès.');</script>";
    } else {
        echo "<script>alert('Échec de la mise à jour du fichier CSV.');</script>";
    }
}//sa maman
debannirIP($ip);
echo "<script>window.location.href = 'PagesUtilisateur/tableau_de_bord_utilisateur.php?journal=rpi';</script>";
?>