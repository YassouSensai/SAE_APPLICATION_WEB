<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
    <meta charset="UTF-8">
    <meta name="description" content="La description du site">
    <meta name="keywords" content="mots-clés 1, mots-clés 2">
    <meta name="author" content="TYMCHYSHYN Ostap, Elkhalki Yassine, Husleag Aaron">
    <link rel="stylesheet" href="../../CSS/css_site_statique.css">
</head>
<body>
<section class="header-page-connexion">
    <nav class="nav-header">
        <div class="nav-logos">
            <ul>
                <li><a href="../index.php">
                        <img class="logo-rond" src="../../images/logo1.png" alt="logo site">
                    </a>
                </li>
                <li><a href="https://www.iut-velizy-rambouillet.uvsq.fr/">
                        <img src="../../images/logo_iut.png" alt="logo iut">
                    </a>
                </li>
            </ul>
        </div>
        <div class="nav-liens">
            <ul>
                <li><a href="../chartegraphique.php">CHARTE GRAPHIQUE</a></li>
                <li><a href="../logo1.php">LOGO 1</a></li>
                <li><a href="../logo2.php">LOGO 2</a></li>
                <li><a href="connexion.php">CONNEXION</a></li>
            </ul>
        </div>
    </nav>

    <div class="background-container">
        <div class="container">
            <h2>Connexion</h2>
            <form method="post" action="action_connexion.php">
                <div class="form-group">

                    <label for="user-type">Type d'utilisateur</label>
                    <select id="user-type" type="text" name="user-type" required>
                        <option value="Utilisateur">Utilisateur</option>
                        <option value="AdminSysteme">Administrateur système</option>
                        <option value="AdminWeb">Administrateur WEB</option>
                        <option value="Technicien">Technicien</option>
                    </select>

                    <label for="username">Identifiant</label>
                    <input id="username" type="text" name="username" placeholder="Identifiant" required>

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
            <p style="color: black">Pas de compte ? Inscrivez-vous <a href="inscription.php">ici</a>.</p>
        </div>
    </div>
</section>
<?php
if (isset($_GET['err'])){
    echo "<p id='error-message' style='color: red'>Impossible de vous connecter. Veuillez réessayer !</p>";
}
?>
<script>
    // Code JavaScript pour cacher le message d'erreur après quelques secondes
    setTimeout(function() {
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 3000);
</script>
<?php
include('../../HTML/pied.html');
?>
</body>
</html>
