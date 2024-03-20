<?php

// Données à inclure dans le fichier CSV
$data = array(
    array('Nom', 'Âge', 'Email'),
    array('John Doe', 30, 'john@example.com'),
    array('Jane Smith', 25, 'jane@example.com'),
    array('Bob Johnson', 35, 'bob@example.com')
);

// Nom du fichier CSV à télécharger
$csvFileName = 'fichier.csv';

// Ouvrir un flux temporaire en écriture
$tempCsvFile = fopen('php://temp', 'w+');

// Vérifier si le flux temporaire est ouvert avec succès
if ($tempCsvFile !== false) {
    // Écrire les données dans le fichier CSV temporaire
    foreach ($data as $row) {
        fputcsv($tempCsvFile, $row);
    }

    // Positionner le curseur du flux au début du fichier
    rewind($tempCsvFile);

    // Configurer les en-têtes HTTP pour forcer le téléchargement
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $csvFileName . '"');

    // Transférer le contenu du fichier temporaire vers la sortie standard (navigateur)
    fpassthru($tempCsvFile);

    // Fermer le flux temporaire
    fclose($tempCsvFile);

    // Arrêter l'exécution du script après le téléchargement
    exit;
} else {
    echo "Impossible de créer le fichier CSV temporaire.";
}
?>
