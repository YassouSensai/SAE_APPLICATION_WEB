<?php
$file = '/chemin/absolu/vers/etc/fail2ban/jail.conf';
$content = file_get_contents($file);
if ($content === false) {
    echo "Impossible de lire le fichier";
} else {
    echo "<pre>$content</pre>";
}
?>
