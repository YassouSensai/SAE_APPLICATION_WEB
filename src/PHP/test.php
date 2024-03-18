<?php
//jail.conf
//$jail = '/etc/fail2ban/jail.conf';

$fail2ban = '/var/log/fail2ban.log';
$content = file_get_contents($fail2ban);
if ($content === false) {
    echo "Impossible de lire le fichier";
} else {
    echo "<pre>$content</pre>";
}
?>
