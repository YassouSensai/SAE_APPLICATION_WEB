<?php
include ("../Autres/fonctions.php")
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../CSS/css_site_dynamique.css">
    <title>Modification du profil</title>
    <meta charset="utf-8">
    <meta name="description" content="Cette page est celle qui permet aux utilisateurs de modifier leurs informations personnelles">
    <meta name="keywords" content="modifier informations personnelles">
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
            echo "<h1>Bienvenue sur le formulaire de modification du profil $username </h1>";
        }
        ?>
    </div>
</section>


<?php
$table_user = "";
if (isset($_SESSION['table_user'])){
    $table_user = $_SESSION['table_user'];
}
?>



<a href="utilisateur.php">Revenir à mon profil</a>
</body>