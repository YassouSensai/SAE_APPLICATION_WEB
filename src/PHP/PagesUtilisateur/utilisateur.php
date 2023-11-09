

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../CSS/css_entete_connecte.css">
    <title>Entete</title>
    <meta charset="utf-8">
    <meta name="description" content="la description du site">
    <meta name="keywords" content="mots-clés 1 mots-clés 2">
    <meta name="author" content="TYMCHYSHYN Ostap, Elkhalki Yassine, Husleag Aaron">


</head>
<body>

<section class="header-page-générale">
    <nav class="nav-header">
        <div class="nav-logos">
            <ul>
                <li class="lien-haut-centre">
                    <a href="../index.php">
                        <img class="logo-rond" src="../../images/logo1.png" alt="logo site">
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="texte-header">
        <?php
        session_start();

        if (isset($_SESSION['utilisateur'])) {
            $username = $_SESSION['utilisateur'];
            echo "<h1>Bienvenue sur votre profil $username </h1>";
        }
        ?>
    </div>
</section>
</body>

<?php
include ("../../HTML/pied.html");
?>
</html>

