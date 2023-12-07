<?php
include("../Autres/fonctions.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="../../CSS/css_site_dynamique.css">
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
        if (isset($_SESSION['utilisateur'], $_SESSION['table_user'])) {
            $username = $_SESSION['utilisateur'];
            $table_user = $_SESSION['table_user'];
            echo "<h1>Bienvenue sur votre profil $username </h1>";
        }
        ?>
    </div>
</section>

<br>
<br>
<br>



<div class='action-button'>
    <ul class='button-list'>
        <?php
        $_SESSION['utilisateur'] = $username;
        $_SESSION['table_user'] = $table_user;

        if ($table_user == 'Utilisateur') {
            echo "<li><button type='button' onclick=\"window.location.href='./utilisateur.php?formulaire=modifier'\">Modifier mon profil</button></li>";
            echo "<li><button type='button' onclick=\"window.location.href='./utilisateur.php?formulaire=ticket'\">Ouvrir un ticket</button></li>";
        }
        echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php'\">Tableau de bord</button></li>";
        ?>
    </ul>
</div>

<br>
<br>


<section class="corps-de-la-page">
    <div id="profil">
        <?php
        tableau_profil($username, $table_user);
        ?>
    </div>

    <?php

    if ($table_user == 'Utilisateur') {
        echo "<div id='formulaires'>";

        if (isset($_GET['formulaire'])) {
            $param_formulaire = $_GET['formulaire'];
            if ($param_formulaire == 'modifier') {
                afficherFormulaireModifierProfil($username, $table_user);
            } elseif ($param_formulaire == 'ticket') {
                afficherFormulaireOuvertureTicket();
            }
        }
        echo "</div>";
    }
    ?>

</section>


<div class="action-button">
    <?php
    echo "<br>";
    echo "<br>";
    echo "<a href='../Authentification/deconnexion.php'><img src='../../images/out.svg' width='50' height='50'></a>";
    ?>
</div>



</body>

<?php
include("../../HTML/pied.html");
?>

</html>
