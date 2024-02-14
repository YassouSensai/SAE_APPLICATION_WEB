<?php
include("../Autres/fonctions_generales.php");
include("../Autres/fonctions_utilisateurs_inscrits.php");
include("../Autres/fonctions_techniciens.php");
include("../Autres/fonctions_administrateur_web.php");
include("../Autres/fonctions_administrateur_systeme.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="../../CSS/css_site_dynamique.css">
    <title>Utilisateur</title>
    <script src="../../JS/messages.js"></script>
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

            $_SESSION['utilisateur'] = $username;
            $_SESSION['table_user'] = $table_user;
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
        if ($table_user == 'utilisateur') {
            echo "<li><button type='button' onclick=\"window.location.href='./utilisateur.php?formulaire=modifierProfil'\">Modifier mon profil</button></li>";
            echo "<li><button type='button' onclick=\"window.location.href='./utilisateur.php?formulaire=modifierMdp'\">Modifier mon mot de passe</button></li>";
            echo "<li><button type='button' onclick=\"window.location.href='./utilisateur.php?formulaire=ticket'\">Ouvrir un ticket</button></li>";
            echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php'\">Tableau de bord</button></li>";
        } elseif ($table_user == "adminsysteme") {
            echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?journal=connexion'\">Tableau de bord</button></li>";
        } elseif ($table_user == "adminweb") {
            echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?liste=tickets'\">Tableau de bord</button></li>";
        } else {
            echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php'\">Tableau de bord</button></li>";
        }
        ?>
    </ul>
</div>

<br>
<br>


<section class="corps-de-la-page">

    <?php
    if ($table_user == 'utilisateur') {
        echo "<div id='profil-utilisateur'>";
        echo "<br>";
        echo "<h2 style='text-align: center'>Mon profil</h2>";
        echo "<br>";
        echo "<br>";
        tableau_profil($username, $table_user);
        echo "</div>";

        echo "<div id='formulaires'>";
        if (isset($_GET['formulaire'])) {
            $param_formulaire = $_GET['formulaire'];
            if ($param_formulaire == 'modifierProfil') {
                echo "<br>";
                echo "<h2 style='text-align: center'>Modifier mon profil</h2>";
                echo "<br>";
                echo "<br>";
                afficherFormulaireModifierProfil($username, $table_user);
            } elseif ($param_formulaire == 'ticket') {
                echo "<br>";
                echo "<h2 style='text-align: center'>Ouvrir un ticket</h2>";
                echo "<br>";
                echo "<br>";
                afficherFormulaireOuvertureTicket();
            } elseif ($param_formulaire == 'modifierMdp') {
                echo "<br>";
                echo "<h2 style='text-align: center'>Modifier mon mot de passe</h2>";
                echo "<br>";
                echo "<br>";
                afficherModifierMotDePasse($username, $table_user);
            }
        }
        echo "</div>";
    } else {
        echo "<div id='profil-general'>";
        echo "<br>";
        echo "<h2 style='text-align: center'>Mon profil</h2>";
        echo "<br>";
        echo "<br>";
        tableau_profil($username, $table_user);
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

<?php
if (isset($_GET['modif_profil'])) {
    $code_modif = $_GET['modif_profil'];

    if ($code_modif == 'succes') {
        echo "<p id='success' style='color: green'>Votre profil a été modifié avec succès !</p>";
    } elseif ($code_modif == 'echec') {
        echo "<p id='error-message' style='color: red'>Votre profil n'a pas pu être modifié !</p>";
    } elseif ($code_modif == 'echec_mdp') {
        echo "<p id='error-message' style='color: red'>Votre mot de passe est incorrect. Veuillez réessayer !</p>";
    } elseif ($code_modif == 'else') {
        echo "<p id='error-message' style='color: red'>Veuillez réessayer ultérieurement !</p>";
    } if ($code_modif == 'succes_mdp') {
        echo "<p id='success' style='color: green'>Votre mot de passe a été modifié avec succès !</p>";
    } elseif ($code_modif == 'echec_mdp') {
        echo "<p id='error-message' style='color: red'>Votre mot de passe n'a pas pu être modifié !</p>";
    }
} elseif (isset($_GET['ouvrir_ticket'])) {
    $code_ticket = $_GET['ouvrir_ticket'];

    if ($code_ticket == 'ok') {
        echo "<p id='success' style='color: green'>Votre ticket a été ouvert avec success. Veuillez attendre qu'un technicien l'inspecte !</p>";
    } elseif ($code_ticket == 'echec_mdp') {
        echo "<p id='error-message' style='color: red'>Votre mot de passe est incorrect. Veuillez réessayer !</p>";
    } elseif ($code_ticket == 'else') {
        echo "<p id='error-message' style='color: red'>Votre ticket n'a pas pu être ouvert. Veuillez réessayer ultérieurement !</p>";
    }
}

?>

</body>

<?php
include("../../HTML/pied.html");
?>

</html>
