<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../CSS/css_site_statique.css">
    <title>Connexion</title>
    <meta charset="UTF-8">
    <meta name="description" content="La description du site">
    <meta name="keywords" content="mots-clés 1, mots-clés 2">
    <meta name="author" content="TYMCHYSHYN Ostap, Elkhalki Yassine, Husleag Aaron">
</head>
<body>

<?php

include('../HTML/entete.html');

if (isset($_GET['err'])){
    echo "<p style='color: red'>Impossible de vous connecter. Veuillez réessayer !</p>";
}
?>

<div class="container">
    <h2>Connexion</h2>
    <form method="post" action="../PHP/action_connexion.php">
        <div class="form-group">
            <label for="pseudo">Identifiant</label>
            <input id="pseudo" type="text" name="pseudo" placeholder="Identifiant" required>

            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" placeholder="Mot de passe" required>

            <?php
            session_start();
            $nb1 = rand(1,10);
            $nb2 = rand(1,20);

            $_SESSION['nb1'] = $nb1;
            $_SESSION['nb2'] = $nb2;

            echo "<label for='captcha'>Captcha : ".$nb1." x ".$nb2." = ? (requis)</label>";
            echo "<input id='captcha' type='number' name='captcha' placeholder='Résultat' required>";
            ?>

            <input style="color: #303030" type="submit" value="Se connecter">
        </div>
    </form>
</div>

<?php
include('../HTML/pied.html');
?>
</body>
</html>
