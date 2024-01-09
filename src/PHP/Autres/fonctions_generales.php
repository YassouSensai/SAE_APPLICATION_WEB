<?php
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

function logActivity($username, $type, $description) {
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

function captchaForm() {
    $nb1 = rand(1,10);
    $nb2 = rand(1,20);

    $_SESSION['nb1'] = $nb1;
    $_SESSION['nb2'] = $nb2;

    echo "<label for='captcha'>Captcha : ".$nb1." x ".$nb2." = ? (requis)</label>";
    echo "<input id='captcha' type='number' name='captcha' placeholder='Résultat' required>";
}

function verifCaptcha($result_captcha) {
    $nb1 = $_SESSION['nb1'];
    $nb2 = $_SESSION['nb2'];
    $result = $nb1 * $nb2;

    if ($result == $result_captcha) {
        return true;
    } else {
        return false;
    }

}













?>