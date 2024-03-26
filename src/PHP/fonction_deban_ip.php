<?php
if(isset($_GET['ip'])) {
    $ip = $_GET['ip'];
} else {
    echo "<script>alert('Erreur : Aucune adresse IP fournie.');</script>";
    exit; // Quitte le script si aucune adresse IP n'est fournie
}

function debannirIP($ip, $jail = 'sshd') {
    $command = "sudo /usr/bin/fail2ban-client set $jail unbanip $ip 2>&1";

    exec($command, $output, $returnVar);

    if ($returnVar === 0) {
        echo "<script>alert('L\'adresse IP $ip a été débannie avec succès.');</script>";
    } else {
        echo "<script>alert('Échec du débannissement de l\'adresse IP $ip.');</script>";
    }

    $cheminScript = '../../../save_and_clear_fail2ban_log.sh';
    $returnVarScript = shell_exec($cheminScript);

    if ($returnVarScript === 0) {
        echo "<script>alert('Le script save_and_clear_fail2ban_log.sh a été exécuté avec succès.');</script>";
    } else {
        echo "<script>alert('Échec de l\'exécution du script save_and_clear_fail2ban_log.sh.');</script>";
    }
}

debannirIP($ip);
echo "<script>window.location.href = 'PagesUtilisateur/tableau_de_bord_utilisateur.php?journal=rpi';</script>";
?>
