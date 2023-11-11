<?php
if (isset($_GET['utilisateur'], $_GET['table_util'])) {
    $username = $_GET['utilisateur'];
    $table_util = $_GET['table_util'];

    echo "<h1>Désolé $username, cette fonction n'est pas encore disponible</h1>";
    echo "<a href='utilisateur.php'>Revenir à mon profil</a>";
}
