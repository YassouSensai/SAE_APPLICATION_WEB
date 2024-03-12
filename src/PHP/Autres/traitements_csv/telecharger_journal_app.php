<?php
include("../fonctions_generales.php");
if (isset($_POST["telecharger_csv"], $_POST['type_journal'])) {
    $type = $_POST['type_journal'];
    $connexion = connectDB();

    $csvContent = '';
    $csvContent .= "Date d'activité,Adresse IP,Utilisateur,Description\n";
    $query_csv = "SELECT date_activite, adresse_ip, id_utilisateur, description_activite FROM journalactivite WHERE type_activite = ?";
    $resultat_csv = prepareAndExecute($connexion, $query_csv, ["i", $type]);
    while ($row_csv = mysqli_fetch_assoc($resultat_csv)) {
        $csvContent .= '"' . $row_csv['date_activite'] . '","' . $row_csv['adresse_ip'] . '","' . $row_csv['id_utilisateur'] . '","' . $row_csv['description_activite'] . "\"\n";
    }

    // Télécharger le fichier CSV
    $filename = 'journal_activite.csv';
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    echo $csvContent;

    // Rediriger vers le tableau de bord
    mysqli_close($connexion);
    echo "<script>window.location.href='./tableau_de_bord_utilisateur.php';</script>";
    exit();
}
?>
