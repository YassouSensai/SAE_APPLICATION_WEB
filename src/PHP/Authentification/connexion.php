<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../CSS/css_site_statique.css">
    <title>Connexion</title>
    <script src="../../JS/messages.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="La description du site">
    <meta name="keywords" content="mots-clés 1, mots-clés 2">
    <meta name="author" content="TYMCHYSHYN Ostap, Elkhalki Yassine, Husleag Aaron">
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
                <button class="connexion" id="boutton-connexion"> CONNEXION </button>
            </ul>
        </div>
        <script>
            var bouton = document.getElementById('boutton-connexion');
            bouton.addEventListener('click', function() {
                window.location.href = 'connexion.php';
            });
        </script>
    </nav>


    <div class="background-container">
        <div class="container">
            <h2>Connexion</h2>
            <form method="post" action="action_connexion.php">
                <div class="form-group">

                    <label for="user-type">Type d'utilisateur</label>
                    <select id="user-type" type="text" name="user-type" required>
                        <option value="utilisateur">Utilisateur</option>
                        <option value="adminsysteme">Administrateur système</option>
                        <option value="adminweb">Administrateur WEB</option>
                        <option value="technicien">Technicien</option>
                    </select>


                    <label for="username">Identifiant</label>
                    <input id="username" type="text" name="username" placeholder="Identifiant" required>

                    <?php
                    include("../Autres/fonctions_generales.php");
                    oeilMdp("password", "Votre mot de passe" , "password", "Mot de passe");
                    session_start();
                    //captchaForm();
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
} elseif (isset($_GET['reussite'])) {
    echo "<p id='success' style='color: green'>Inscription réalisée avec succès !</p>";
}
?>
<?php
include('../../HTML/pied.html');
?>
</body>
</html>
