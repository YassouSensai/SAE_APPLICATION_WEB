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
    <link rel="icon" href="../../images/logo1noirtrans.webp">
    <link rel="stylesheet" href="../../CSS/css_site_dynamique.css">
    <title>Votre tableau de bord</title>
    <script src="../../JS/messages.js"></script>
    <script>
        function supprimerTicket(ticketId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce ticket ?')) {
                var form = document.createElement('form');
                document.body.appendChild(form);
                form.method = 'post';
                form.action = '../PagesUtilisateur/Traitement_BD/traitement_suppression_ticket.php';
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ticket_supprimer';
                input.value = ticketId;
                form.appendChild(input);
                form.submit();
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('repertoire').addEventListener('change', function(e) {
                var chemin = e.target.value;
                document.getElementById('chemin_selectionne').value = chemin;
            });
        });
    </script>


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
<div class="action-button-profil">
    <table style="margin: 0 auto; border-collapse: collapse;">
        <tr>
            <td style="border: none; text-align: center;">
                <a href='../PagesUtilisateur/utilisateur.php'><img src='../../images/fleche-de-reference.svg' width='50' height='50' alt="revenir en arrière"></a>
            </td>
            <td style="border: none; text-align: center;">
                <a href='../Authentification/deconnexion.php'><img src='../../images/out.svg' width='50' height='50' alt="se déconnecter"></a>
            </td>
        </tr>
    </table>
</div>



<section class="corps-de-la-page-2">


    <?php
    if ($table_user == 'utilisateur'){
        echo "<div id='vos-tickets-utilisateurs'>";

        echo "<h2>Vos tickets :</h2>";
        echo "<br>";
        echo "<br>";
        afficherTicketsUtilisateurs($username, $table_user);

        echo "</div>";

    } elseif ($table_user == 'technicien') {
        echo "<div id='vos-tickets-techniciens'>";

        echo "<h2>Vos tickets pris en charge :</h2>";
        echo "<br>";
        echo "<br>";
        afficherTicketsUtilisateurs($username, $table_user);
        echo "</div>";

        echo "<div id='formulaires-tickets'>";
        echo "<ul class='button-list'>";
        echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?formulaire=modifierTicket'\">Modifier un ticket</button></li>";
        echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?formulaire=nouveauTicket'\">Prendre un ticket disponible</button></li>";
        echo "</ul>";

        echo "<br>";
        echo "<br>";

        if (isset($_GET['formulaire'])) {
            $formulaire = $_GET['formulaire'];
            echo "<br>";
            echo "<br>";
            if ($formulaire == 'modifierTicket') {
                afficherFormModifierStatutTicket($username);
            } elseif ($formulaire == 'nouveauTicket') {
                afficherFormChoixTicketsNonAttribues();
            }
        }

        echo "</div>";

    } elseif ($table_user == "adminsysteme") {
        echo "<div id='journal'>";

        echo "<ul class='button-list'>";
        echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?journal=connexion'\">Journal des connexions</button></li>";
        echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?journal=tickets'\">Journal des tickets</button></li>";
        echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?journal=rpi'\">Journal du RPI</button></li>";
        echo "</ul>";

        echo "<br>";
        echo "<br>";

        if (isset($_GET['journal'])) {
            $journal = $_GET['journal'];

            if ($journal == 'connexion') {
                echo "<h2>Journal des connexions :</h2>";
                echo "<br>";
                echo "<br>";
                // Ajout de la pagination pour le journal des connexions
                if(isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                afficherActivitesParType(1, $page);
            } elseif ($journal == 'tickets') {
                echo "<h2>Journal des tickets :</h2>";
                echo "<br>";
                echo "<br>";
                // Ajout de la pagination pour le journal des tickets
                if(isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                afficherActivitesParType(0, $page);
            } elseif ($journal == 'rpi') {
                echo "<h2>Journal du RPI :</h2>";
                echo "<br>";
                echo "<br>";
                echo "<link rel='stylesheet' href='../../CSS/css_fonctions.css'>";
                $log = "2024-03-20 14:00:00,000 fail2ban.server         [1234]: INFO    Starting Fail2ban v0.10.4
    2024-03-20 14:00:00,001 fail2ban.database       [1234]: INFO    Connected to fail2ban persistent database '/var/lib/fail2ban/fail2ban.sqlite3'
    2024-03-20 14:00:00,002 fail2ban.jail           [1234]: INFO    Creating new jail 'sshd'
    2024-03-20 14:00:00,003 fail2ban.jail           [1234]: INFO    Jail 'sshd' started
    2024-03-20 14:16:53,158 fail2ban.actions        [2631]: NOTICE  [sshd] Ban 192.168.0.219
    2024-03-20 14:19:25,848 fail2ban.actions        [2688]: NOTICE  [sshd] Unban 192.168.0.219
    2024-03-20 14:23:08,432 fail2ban.actions        [2957]: NOTICE  [sshd] Ban 192.168.1.42
    2024-03-20 14:50:00,000 fail2ban.actions        [3000]: NOTICE  [sshd] Unban 192.199.199.199
    2024-03-20 14:51:40,908 fail2ban.jail           [3000]: INFO    Jail 'sshd' stopped
    2024-03-20 14:52:00,000 fail2ban.server         [1234]: INFO    Exiting Fail2ban";
                $resultats = traiterJournal($log);
                afficherTraiterJournal($resultats);
            }
        }

        echo "</div>";

    } elseif ($table_user == 'adminweb') {

        if (isset($_GET['liste'])) {
            $_SESSION['liste'] = $_GET['liste'];
        }

        if (isset($_GET['action'])) {
            $_SESSION['action'] = $_GET['action'];
        }

        $liste = '';
        if (isset($_SESSION['liste'])) {
            $liste = $_SESSION['liste'];
        }

        $action = '';
        if (isset($_SESSION['action'])) {
            $action = $_SESSION['action'];
        }

        echo "<div id='liste-tickets-utilisateurs'>";

        echo "<ul class='button-list'>";
        echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?liste=tickets&action=$action'\">Tous les tickets</button></li>";
        echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?liste=utilisateurs&action=$action'\">Tous les utilisateurs</button></li>";
        echo "</ul>";

        echo "<br>";
        echo "<br>";

        if (isset($_GET['liste'])) {
            $liste = $_GET['liste'];
            if ($liste == 'tickets') {
                echo "<h2>Liste de tous les tickets :</h2>";
                echo "<br>";
                echo "<br>";
                afficherTicketsAvecDetails();
            } elseif ($liste == 'utilisateurs') {
                echo "<h2>Liste de tous les utilisateurs :</h2>";
                echo "<br>";
                echo "<br>";
                afficherUtilisateurs();
            }
        }

        echo "</div>";

        echo "<br>";
        echo "<br>";

        echo "<div id='actions-admin-web'>";

        echo "<ul class='button-list'>";
        echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?action=inscrire_tech&liste=$liste'\">Inscrire un technicien</button></li>";
        echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?action=ticket_tech&liste=$liste'\">Attribuer un ticket à un technicien</button></li>";
        echo "<li><button type='button' onclick=\"window.location.href='./tableau_de_bord_utilisateur.php?action=ticket_suppr&liste=$liste'\">Supprimer un ticket</button></li>";
        echo "</ul>";

        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";

        if (isset($_GET['action'])) {
            $action = $_GET['action'];

            if($action == 'inscrire_tech') {
                afficherFormulaireInscriptionTechnicien();
            } elseif ($action == "ticket_tech") {
                afficherFormulaireAttributionTicket();
            } elseif ($action == "ticket_suppr") {
                afficherFormulaireSuppressionTicket();
            }
        }

        echo "</div>";

    }

    ?>

</section>

<section>
   <?php
   if (isset($_GET['modif_statut'])) {
       $modif_statut = $_GET['modif_statut'];
       if ($modif_statut == 'echec') {
           echo "<p id='error-message' style='color: red'>Le statut du ticket n'a pas pu être modifié !</p>";
       } elseif ($modif_statut == 'succes') {
           echo "<p id='success' style='color: green'>Le statut du ticket a été modifié avec succès !</p>";
       }
   } elseif (isset($_GET['attribution_ticket'])) {
       $attribution_ticket = $_GET['attribution_ticket'];
       if ($attribution_ticket == 'echec') {
           echo "<p id='error-message' style='color: red'>Ce ticket n'a pas pu vous être attribué !</p>";
       } elseif ($attribution_ticket == 'succes') {
           echo "<p id='success' style='color: green'>Ce ticket vous a été attribué avec succès !</p>";
       }
   } elseif (isset($_GET['suppr'])) {
       $suppr = $_GET['suppr'];
       if ($suppr == 'ok') {
           echo "<p id='success' style='color: green'>Ce ticket a bien été supprimé !</p>";
       } elseif ($suppr == 'echec' || $suppr == 'else') {
           echo "<p id='error-message' style='color: red'>Ce ticket n'a pas pu être supprimé !</p>";
       }
   } elseif (isset($_GET['attr'])) {
       $attr = $_GET['attr'];
       if ($attr == 'ok') {
           echo "<p id='success' style='color: green'>Ce ticket a bien été attribué au technicien !</p>";
       } elseif ($attr == 'echec') {
           echo "<p id='error-message' style='color: red'>Ce ticket n'a pas pu être attribué au technicien !</p>";
       }
   } elseif (isset($_GET['inscr'])) {
       $inscr = $_GET['inscr'];
       if ($inscr == 'ok') {
           echo "<p id='success' style='color: green'>Le technicien a bien été créé !</p>";
       } elseif ($inscr == 'echec') {
           echo "<p id='error-message' style='color: red'>Ce technicien n'a pas pu être créé !</p>";
       } elseif ($inscr == 'echec_id') {
           echo "<p id='error-message' style='color: red'>Ce technicien existe déjà ! Veuillez mettre un autre identifiant.</p>";
       }
   }
   elseif (isset($_GET['csv'])) {
       $csv = $_GET['csv'];
       if ($csv == 'success') {
           echo "<p id='success' style='color: green'>Le journal a bien été téléchargé au format csv !</p>";
       } elseif ($csv == 'error') {
           echo "<p id='error-message' style='color: red'>Le journal n'a pas pu être téléchargé au format csv !</p>";
       }
   }
   ?>
</section>

<?php
include("../../HTML/pied.html");
?>
</body>