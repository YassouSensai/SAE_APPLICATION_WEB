<?php
include ("../Autres/fonctions.php")
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../CSS/css_entete_connecte.css">
    <title>Utilisateur</title>
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
        $username = "";
        if (isset($_SESSION['utilisateur'])) {
            $username = $_SESSION['utilisateur'];
            echo "<h1>Bienvenue sur votre profil $username </h1>";
        }
        ?>
    </div>
</section>

<section>
    <div>
        <?php
        if (isset($_SESSION['table_user'])){
            $table_user = $_SESSION['table_user'];
            tableau_profil($username, $table_user);
        }
        ?>
    </div>

    <div class='action-button'>
        <?php
        echo "<a href='ouverture_ticket.php?utilisateur=$username&table_util=$table_user' class='modifier-button'>Ouvrir un ticket</a>";
        echo "<br>";
        echo "<a href='modifier_profil.php?utilisateur=$username&table_util=$table_user' class='modifier-button'>Modifier mon profil</a>";
        echo "<br>";
        echo "<a href='tableau_de_bord_utilisateur.php?utilisateur=$username&table_util=$table_user' class='modifier-button'>Accèder à mon tableau de bord</a>";
        echo "<br>";
        echo "<br>";
        echo "<a href='../Authentification/deconnexion.php'><img src='../../images/out.svg' width='50' height='50'></a>";
        ?>
    </div>
</section>
</body>

<?php
include ("../../HTML/pied.html");
?>
</html>

