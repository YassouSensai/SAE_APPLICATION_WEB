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
        $table_user = "";
        if (isset($_SESSION['utilisateur'], $_SESSION['table_user'])) {
            $username = $_SESSION['utilisateur'];
            $table_user = $_SESSION['table_user'];
            echo "<h1>Bienvenue sur votre tableau de bord $username </h1>";
        }
        ?>
    </div>
</section>
<br>
<br>
<a href="utilisateur.php">Revenir à mon profil</a>
<br>

<section class="corps-de-la-page-2">


    <?php
    if ($table_user == 'Utilisateur'){

        echo "<div id='vos-tickets'>";
        echo "<h2>Vos tickets :</h2>";
        echo "<br>";
        echo "<br>";
        afficherTicketsUtilisateurs($username, $table_user);
        echo "</div>";
    }

    ?>

</section>

<?php
include("../../HTML/pied.html");
?>
</body>