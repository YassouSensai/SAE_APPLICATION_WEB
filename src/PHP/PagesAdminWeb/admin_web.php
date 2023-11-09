<?php
session_start();

if (isset($_SESSION['utilisateur'])) {
    $username = $_SESSION['utilisateur'];

    echo "<h1>Coucou $username</h1>";
}
