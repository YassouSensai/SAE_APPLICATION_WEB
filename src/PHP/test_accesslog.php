<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Apache Access Log</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        pre {
            white-space: pre-wrap;       /* Since CSS 2.1 /
            white-space: -moz-pre-wrap;  / Mozilla, since 1999 /
            white-space: -pre-wrap;      / Opera 4-6 /
            white-space: -o-pre-wrap;    / Opera 7 /
            word-wrap: break-word;       / Internet Explorer 5.5+ */
        }
    </style>
</head>
<body>

<h2>Contenu du Access.log</h2>

<?php
$file = '/var/log/apache2/access.log';

// Assurez-vous que le chemin d'accès est correct et que vous avez la permission de lire le fichier
if (file_exists($file)) {
    $content = file_get_contents($file);
    if ($content !== false) {
        echo "<pre>$content</pre>";
    } else {
        echo "Impossible de lire le fichier";
    }
} else {
    echo "Le fichier n'existe pas";
}
?>

</body>
</html>