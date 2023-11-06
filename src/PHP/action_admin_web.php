<?php
// Inclure la connexion à la base de données MySQL avec PDO
try {
    $pdo = new PDO("mysql:host=localhost;dbname=tp5", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de la connexion à la base de données : " . $e->getMessage());
}

session_start();

if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['captcha'])) {
    $pseudo = $_POST['pseudo'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $captcha = $_POST['captcha'];

    if (!isset($_SESSION['captcha']) || ($_SESSION['captcha'] != $captcha)) {
        // Redirection vers la page de connexion en cas d'échec de connexion
        header('Location: connexion.php');
        exit();
    }

    // Utilisez des requêtes préparées pour éviter les attaques par injection SQL
    $query = "SELECT * FROM utilisateur WHERE pseudo = :pseudo AND mot_de_passe = :mot_de_passe";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['utilisateur'] = $result['pseudo']; // L'utilisateur est authentifié, enregistrer la session
        header('Location: profil.php'); // Rediriger vers la page de profil
        exit();
    }
}

// Redirection vers la page de connexion en cas d'échec de connexion
header('Location: connexion.php');

// Traitement des actions de l'administrateur web
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case 'ajouter_libelle':

                break;

            case 'modifier_libelle':
                // ....
                break;

            case 'supprimer_libelle':
                // ....
                break;

            // Gérez d'autres actions liées à la gestion des statuts, niveaux d'urgences, techniciens, etc.

            default:
                // Action inconnue
                break;
        }
    }
}

include 'admin_web.php';
?>
