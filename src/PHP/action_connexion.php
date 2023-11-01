<?php
session_start();

if (isset($_SESSION['nb1']) && isset($_SESSION['nb2'])){
    $nb1 = $_SESSION['nb1'];
    $nb2 = $_SESSION['nb2'];
    $result = $nb1 * $nb2;

    if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['captcha'])){
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
        $captcha = $_POST['captcha'];

        if (($result == $captcha) && ($pseudo === "admin") && ($password === "123")) {
            header('Location: ../HTML/profil.html');
            exit; // Terminer le script après la redirection
        } else {
            header('Location: ../HTML/connexion.php?err');
            exit; // Terminer le script après la redirection
        }
    }
} else {
    header('Location: ../HTML/connexion.php?err');
    exit; // Terminer le script après la redirection
}
?>
