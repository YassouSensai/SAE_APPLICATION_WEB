<?php
session_start();
include("../Autres/fonctions_generales.php");

if (isset($_SESSION['utilisateur'])) {
    $username = $_SESSION['utilisateur'];
    logActivity($username, 1, "L'utilisateur $username s'est déconnecté.");


    session_unset();
    session_destroy();
}

header('Location: ../index.php');
exit();
?>
