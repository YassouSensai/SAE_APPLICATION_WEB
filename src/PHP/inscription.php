<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../CSS/css_site_statique.css">
    <title>Inscription</title>
    <meta charset="UTF-8">
    <meta name="description" content="La description du site">
    <meta name="keywords" content="mots-clés 1, mots-clés 2">
    <meta name="author" content="TYMCHYSHYN Ostap, Elkhalki Yassine, Husleag Aaron">
</head>
<body>

<?php
include('../HTML/entete.html');

if (isset($_GET['err'])) {
    echo "<p id='error-message' style='color: red'>Une erreur s'est produite. Veuillez réessayer !</p>";
}
?>

<div class="container">
    <h2>Inscription</h2>
    <form method="post" action="../PHP/action_inscription.php">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input id="username" type="text" name="username" placeholder="Nom d'utilisateur" required>

            <label for="mail">Adresse e-mail</label>
            <input id="mail" type="email" name="email" placeholder="Adresse e-mail" required>

            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" placeholder="Mot de passe" required>

            <label for="confirm_password">Confirmer le mot de passe</label>
            <input id="confirm_password" type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>

            <?php
            session_start();
            $nb1 = rand(1,10);
            $nb2 = rand(1,20);

            $_SESSION['nb1'] = $nb1;
            $_SESSION['nb2'] = $nb2;

            echo "<label for='captcha'>Captcha : ".$nb1." x ".$nb2." = ? (requis)</label>";
            echo "<input id='captcha' type='number' name='captcha' placeholder='Résultat' required>";
            ?>

            <input style="color: #303030" type="submit" value="S'inscrire">
        </div>
    </form>
</div>

<?php
include('../HTML/pied.html');
?>

<script>
    // Code JavaScript pour cacher le message d'erreur après quelques secondes
    setTimeout(function() {
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 5000); // 5000 millisecondes (5 secondes)
</script>

</body>
</html>
