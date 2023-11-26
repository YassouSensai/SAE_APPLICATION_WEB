<?php
include ("../Autres/fonctions.php")
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../CSS/css_site_dynamique.css">
    <title>Ouverture d'un ticket (utilisateur)</title>
    <meta charset="utf-8">
    <meta name="description" content="Cette page est celle qui permet aux utilisateurs inscrits (élève et profs) de créer un ticket">
    <meta name="keywords" content="ticket ouvrir élève prof inscrit">
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
            echo "<h1>Bienvenue sur le formulaire d'ouverture de ticket $username </h1>";
        }
        ?>
    </div>
</section>

<a href="utilisateur.php">Revenir à mon profil</a>
</body>