<?php
include("../fonctions_generales.php");

if (isset($_POST['type_journal']) && isset($_POST['choix_journal'])) {
    $connexion = connectDB();
    $type_journal = $_POST['type_journal'];
    $choix_journal = $_POST['choix_journal'];

    $csvFileName = '';

    if ($type_journal == 1) {
        if ($choix_journal == 'connecté') {
            $csvFileName = 'journal_connexions.csv';
        } elseif ($choix_journal == 'déconnecté') {
            $csvFileName = 'journal_deconnexions.csv';
        }
    } else {
        if ($choix_journal == 'créé') {
            $csvFileName = 'journal_creations.csv';
        } elseif ($choix_journal == 'supprimé') {
            $csvFileName = 'journal_suppressions.csv';
        } elseif ($choix_journal == 'attribué') {
            $csvFileName = 'journal_attributions.csv';
        }
    }

    $query = "SELECT * FROM journalactivite WHERE type_activite = ? AND description_activite LIKE ?";
    $params = ["is", $type_journal, "%$choix_journal%"];
    $resultat = prepareAndExecute($connexion, $query, $params);

    $csvData = array();
    $csvData[] = array('Date d\'activité', 'Adresse IP', 'Utilisateur', 'Description');

    while ($row = mysqli_fetch_assoc($resultat)) {
        $csvData[] = array($row['date_activite'], $row['adresse_ip'], $row['id_utilisateur'], $row['description_activite']);
    }

    // Création d'un fichier CSV temporaire
    $tempCsvFile = fopen('php://temp', 'w+');
    if ($tempCsvFile !== false) {
        foreach ($csvData as $row) {
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

        mysqli_close($connexion);
        exit();
    } else {
        mysqli_close($connexion);
        echo "Erreur lors de la création du fichier CSV temporaire. Désolé pour la gène occasionnée. Veuillez reveni en arrière et réessayer !";
    }
}

?>
