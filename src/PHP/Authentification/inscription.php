<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../CSS/css_site_statique.css">
    <title>Inscription</title>
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
            <h2>Inscription</h2>
            <form method="post" action="action_inscription.php">
                <div class="form-group">
                    <label for="username">Identifiant</label>
                    <input id="username" type="text" name="username" placeholder="Identifiant" required>

                    <label for="nom">Nom</label>
                    <input id="nom" type="text" name="nom" placeholder="Nom" required>

                    <label for="prenom">Prénom</label>
                    <input id="prenom" type="text" name="prenom" placeholder="Prénom" required>

                    <label for="mail">Adresse e-mail</label>
                    <input id="mail" type="email" name="email" placeholder="Adresse e-mail" required>

                    <?php
                    include("../Autres/fonctions_generales.php");
                    oeilMdp("password", "password", "Mot de passe");
                    oeilMdp("confirm_password", "confirm_password", "Confirmer le mot de passe");
                    ?>

                    <label for="type_util">Type d'utilisateur</label>
                    <select id="type_util" type="text" name="type_util" required>
                        <option value="eleve">Eleve</option>
                        <option value="prof">Professeur</option>
                    </select>

                    <?php
                    session_start();
                    captchaForm()
                    ?>

                    <input style="color: #303030" type="submit" value="S'inscrire">
                </div>
            </form>
    </div>
</section>
<?php
if (isset($_GET['err'])){
    $err = $_GET['err'];
    if ($err = "err_inscription") {
        echo "<p id='error-message' style='color: red'>Impossible de vous inscrire. Veuillez réessayer !</p>";
    } elseif ($err = "err_inscription_idenifiant") {
        echo "<p id='error-message' style='color: red'>Cet identifiant est déjà uilisé, veuillez en choisir un autre !</p>";
    } else {
        echo "<p id='error-message' style='color: red'>Veuillez réessayer !</p>";
    }
}


include('../../HTML/pied.html');
?>
</body>
</html>
