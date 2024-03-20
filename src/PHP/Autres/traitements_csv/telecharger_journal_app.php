<?php
include("../fonctions_generales.php");
$connexion = connectDB();

// Type de journal sélectionné
$type_journal = $_POST['type_journal'];

// Options de la liste déroulante sélectionnée
$choix_journal = $_POST['choix_journal'];

// Définition du nom du fichier CSV en fonction des options sélectionnées
$csvFileName = '';

if ($type_journal == 1) {
    if ($choix_journal == 'connexion') {
        $csvFileName = 'journal_connexions.csv';
    } elseif ($choix_journal == 'deconnexion') {
        $csvFileName = 'journal_deconnexions.csv';
    }
} else {
    if ($choix_journal == 'creation') {
        $csvFileName = 'journal_creations.csv';
    } elseif ($choix_journal == 'suppression') {
        $csvFileName = 'journal_suppressions.csv';
    } elseif ($choix_journal == 'attribution') {
        $csvFileName = 'journal_attributions.csv';
    }
}

// Requête SQL pour récupérer les données du journal en fonction du type et de l'option sélectionnés
$query = "SELECT * FROM journalactivite WHERE type_activite = ? AND description_activite LIKE ?";
$params = ["is", $type_journal, "%$choix_journal%"];
$resultat = prepareAndExecute($connexion, $query, $params);

// Création d'un fichier CSV temporaire
$tempCsvFile = fopen('php://temp', 'w+');

// Vérification de la création du fichier CSV temporaire
if ($tempCsvFile !== false) {
    // Écriture des données dans le fichier CSV temporaire
    while ($row = mysqli_fetch_assoc($resultat)) {
        fputcsv($tempCsvFile, $row);
    }

    // Positionnement du curseur du flux au début du fichier
    rewind($tempCsvFile);

    // Configuration des en-têtes HTTP pour forcer le téléchargement
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $csvFileName . '"');

    // Transfert du contenu du fichier temporaire vers la sortie standard (navigateur)
    fpassthru($tempCsvFile);

    // Fermeture du flux temporaire
    fclose($tempCsvFile);

    // Arrêt de l'exécution du script après le téléchargement
    exit;
} else {
    echo "Impossible de créer le fichier CSV temporaire.";
}

// Fermeture de la connexion à la base de données
mysqli_close($connexion);
?>
