<?php
if (isset($_POST["type_journal"], $_POST["nom_fichier"])  && !empty($_POST["nom_fichier"])) {
    // Vérifiez si le type de journal est défini et le nom du fichier n'est pas vide
    if (isset($_POST["type_journal"]) && isset($_POST["nom_fichier"]) && !empty($_POST["nom_fichier"])) {
        $type_journal = $_POST["type_journal"];
        $nom_fichier = $_POST["nom_fichier"];

        // Créez le contenu CSV (dans ce cas, vide)
        $csv_content = '';

        // Créez le chemin du fichier temporaire
        $chemin_fichier = tempnam(sys_get_temp_dir(), $nom_fichier);

        // Écrivez le contenu dans le fichier
        file_put_contents($chemin_fichier, $csv_content);

        // Entête de téléchargement
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($chemin_fichier) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($chemin_fichier));
        ob_clean();
        flush();
        readfile($chemin_fichier);
        exit();
    }
}

// Redirigez si les données sont incorrectes ou si la méthode de requête est incorrecte
header("Location: tableau_de_bord_utilisateur.php");
exit();
?>
