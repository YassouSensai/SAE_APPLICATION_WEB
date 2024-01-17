<?php
/* Cette page php regroupe les fonctions générales nécessaires pour le fonctionnement de l'application dont :
 * - La fonction connectDB() qui permet de se connecter à la base de données de l'application
 * - La fonction preprareAndExecute() qui permet d'exécuter une requête SQL sur la base de données de l'application
 * - La fonction logActivity() qui permet d'inscrire une nouvelle activité dans la table journalActivite de la base de données
 * - La fonction captchaForm() qui généré un captcha pour la plupart des formulaires de l'application
 * - La fonction verifCaptcha() qui permet de verifier si le captcha entré par l'utilisateur est correct.
 * - La fonction scriptMdp() qui contient les scripts à adopter pour afficher un œil pour voir ou non le mot de passe
 * - La fonction oeilMdp() qui permet d'afficher l'input des mots de passes avec l'œil
 * */

if (!function_exists('connectDB')) {
    function connectDB() {
        $serveur = "localhost";
        $utilisateur = "user_sae";
        $mot_de_passe = "azerty";
        $base_de_donnees = "sae_bd";

        $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

        if (!$connexion) {
            die("La connexion a échoué : " . mysqli_connect_error());
        }

        return $connexion;
    }
}


if (!function_exists('prepareAndExecute')) {
    function prepareAndExecute($connexion, $query, $params = null) {
        $prep = mysqli_prepare($connexion, $query);

        if (!$prep) {
            die("La préparation de la requête a échoué : " . mysqli_error($connexion));
        }

        if ($params) {
            mysqli_stmt_bind_param($prep, ...$params);
        }

        mysqli_stmt_execute($prep);

        return mysqli_stmt_get_result($prep);
    }
}




if (!function_exists('logActivity')) {
    function logActivity($username, $type, $description)
    {
        $connexion = connectDB();
        $query = "INSERT INTO JournalActivite (date_activite, adresse_ip, id_utilisateur, type_activite, description_activite) VALUES (NOW(), ?, ?, ?, ?)";


        if (isset($_SESSION['table_user'])) {
            if ($_SESSION['table_user'] == 'Utilisateur') {
                $params = ["ssis", $_SERVER['REMOTE_ADDR'], $username, $type, $description];
                prepareAndExecute($connexion, $query, $params);
            } else {
                $params = ["ssis", $_SERVER['REMOTE_ADDR'], 'NULL', $type, $description];
                prepareAndExecute($connexion, $query, $params);
            }
        }

        mysqli_close($connexion);
    }
}

if (!function_exists('captchaForm')) {
    function captchaForm()
    {
        $nb1 = rand(1, 10);
        $nb2 = rand(1, 20);

        $_SESSION['nb1'] = $nb1;
        $_SESSION['nb2'] = $nb2;

        echo "<label for='captcha'>Captcha : " . $nb1 . " x " . $nb2 . " = ? (requis)</label>";
        echo "<input id='captcha' type='number' name='captcha' placeholder='Résultat' required>";
    }
}


if (!function_exists('verifCaptcha')) {
    function verifCaptcha($result_captcha)
    {
        $nb1 = $_SESSION['nb1'];
        $nb2 = $_SESSION['nb2'];
        $result = $nb1 * $nb2;

        if ($result == $result_captcha) {
            return true;
        } else {
            return false;
        }

    }
}

if (!function_exists('scriptsMdp')) {
    function scriptsMdp()
    {
        echo "<script src='https://unpkg.com/feather-icons'></script>
                  <script>
                        feather.replace();
                  </script>
                  <script src='../../JS/script_oeil_mdp.js'></script>";
    }
}


if (!function_exists('oeilMdp')) {
    function oeilMdp($id, $name, $placeholder, $required = true)
    {
        echo "<label for='$id'>Votre mot de passe:</label>";
        echo "<label class='password-container'>";
        echo "<input type='password' id='$id' name='$name' placeholder='$placeholder' " . ($required ? 'required' : '') . "><br>";
        echo "<div class='password-icon'>";
        echo "<i data-feather='eye'></i>";
        echo "<i data-feather='eye-off'></i>";
        echo "</div>";
        echo "</label>";

        scriptsMdp();
    }
}













?>