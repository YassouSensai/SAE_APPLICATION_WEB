<?php
include ("../Autres/fonctions.php")
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../CSS/css_site_dynamique.css">
    <title>Tableau de bord</title>
    <meta charset="utf-8">
    <meta name="description" content="Cette page permet aux personnes connecté de visionner leur tableau de bord">
    <meta name="keywords" content="tableau">
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
        $username = "";
        if (isset($_SESSION['utilisateur'])) {
            $username = $_SESSION['utilisateur'];
            echo "<h1>Bienvenue sur votre tableau de bord $username </h1>";
        }
        ?>
    </div>
</section>

<section class="afficher-tickets">


</section>

<section class="afficher-utilisateurs">
    /* tableau des utilisateurs (tous les utilisateurs inscrit, puis les techniciens, ensuite l'administrateur système*/


    /* Bouton pour inscrire un nouveau technicien*/
</section>

<a href="utilisateur.php">Revenir à mon profil</a>
</body>