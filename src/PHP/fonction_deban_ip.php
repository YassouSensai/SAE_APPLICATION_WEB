<?php
if(isset($_GET['ip'])) {
    $ip = $_GET['ip'];

} else {
    echo "Erreur : Aucune adresse IP fournie.";
}
function debannirIP($ip, $jail = 'sshd') {
    $command = "sudo /usr/bin/fail2ban-client set $jail unbanip $ip 2>&1";

    exec($command, $output, $returnVar);

    if ($returnVar === 0) {
        echo "L'adresse IP $ip a été débannie avec succès.\n";
    } else {
        echo "Échec du débannissement de l'adresse IP $ip.\n";
    }
    $cheminScript = '/../../save_and_clear_fail2ban_log.sh';

    exec("sudo bash $cheminScript", $outputScript, $returnVarScript);

    if ($returnVarScript === 0) {
        echo "Le script save_and_clear_fail2ban_log.sh a été exécuté avec succès.\n";
    } else {
        echo "Échec de l'exécution du script save_and_clear_fail2ban_log.sh.\n";
    }
}
debannirIP($ip);
header("Location: PagesUtilisateur/tableau_de_bord_utilisateur.php?journal=rpi");
?>
