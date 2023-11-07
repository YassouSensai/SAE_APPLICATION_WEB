<?php
session_start();

if (isset($_SESSION['nb1']) && isset($_SESSION['nb2'])){
    $nb1 = $_SESSION['nb1'];
    $nb2 = $_SESSION['nb2'];
    $result = $nb1 * $nb2;

    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['captcha'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $captcha = $_POST['captcha'];

        if (($result == $captcha) && ($password === $confirm_password)) {
            // Validation réussie, enregistrer les données dans la base de données (simulé ici)
            // Ici, vous devriez utiliser des méthodes de hachage pour stocker le mot de passe de manière sécurisée.
            // C'est juste une démonstration, veuillez utiliser des méthodes de hachage sécurisées dans un vrai scénario.

            // Exemple de connexion à une base de données (simulation)
            // $db = new PDO('mysql:host=adresse_serveur;dbname=nom_bdd', 'utilisateur', 'mot_de_passe');

            // Exemple d'insertion des données dans une table 'utilisateurs' (simulation)
            // $query = $db->prepare("INSERT INTO utilisateurs (username, email, password) VALUES (:username, :email, :password)");
            // $query->execute(array('username' => $username, 'email' => $email, 'password' => $password));

            // Redirection vers la page de profil après inscription réussie (simulation)
            header('Location: ../HTML/profil.html');
            exit; // Terminer le script après la redirection
        } else {
            // Redirection vers la page d'inscription avec une erreur
            header('Location: ../PHP/inscription.php?err');
            exit; // Terminer le script après la redirection
        }
    }
} else {
    // Redirection vers la page d'inscription avec une erreur
    header('Location: ../PHP/inscription.php?err');
    exit; // Terminer le script après la redirection
}
?>
