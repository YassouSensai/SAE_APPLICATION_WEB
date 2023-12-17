<?php
# Génération de la suite chiffrante de RC4 ou Pseudo Random Generator Algorithm PRGA
$message = 'Hello World';
$cle = 'test';
$message = 'Hello';
$cle = 'abc';

function initialize($cle) {
    $longueur_cle = strlen($cle);
    $sequence_cle = range(0, 255);
    $j = 0;

    for ($i = 0; $i < 256; $i++) {
        $j = ($j + $sequence_cle[$i] + ord($cle[$i % $longueur_cle])) % 256;

        // Swap
        $temp = $sequence_cle[$i];
        $sequence_cle[$i] = $sequence_cle[$j];
        $sequence_cle[$j] = $temp;
    }
    return $sequence_cle;
}
function RC4($cle, $message)
{
    $sequence_cle = initialize($cle);
    //$sequence_cle = range(0, 3);
    echo print_r($sequence_cle);
    echo '<br>';
    $message_crypte = '';

    $i = 0;
    $j = 0;

    //boucle pour parcourir le message à crypter
    for ($k = 0; $k < strlen($message); $k++) {
        $i = ($i + 1) % 256;
        $j = ($j + $sequence_cle[$i]) % 256;

        //echange de place des valeurs $sequence_cle[$i] et $sequence_cle[$j]
        $temp = $sequence_cle[$i]; //valeur copié
        $sequence_cle[$i] = $sequence_cle[$j];
        $sequence_cle[$j] = $temp;


        $tempKey = $sequence_cle[($sequence_cle[$i] + $sequence_cle[$j]) % 256]; // valeur que l'on va concaténer dans le message crypté
        $message_crypte = $message_crypte.($message[$k].$tempKey);
    }
    return ($message_crypte);
}

function RC4_decrypt($cle, $message_crypte)
{
    $sequence_cle = initialize($cle);
    $message_decrypte = '';

    $i = 0;
    $j = 0;

    // Boucle pour parcourir le message crypté
    for ($k = 0; $k < strlen($message_crypte); $k += 2) {
        // Mise à jour de l'état interne de RC4
        $i = ($i + 1) % 256;
        $j = ($j + $sequence_cle[$i]) % 256;

        // Échange de place des valeurs $sequence_cle[$i] et $sequence_cle[$j]
        $temp = $sequence_cle[$i];
        $sequence_cle[$i] = $sequence_cle[$j];
        $sequence_cle[$j] = $temp;

        // Calcul de l'octet de la séquence de clés pour le déchiffrement
        $tempKey = $sequence_cle[($sequence_cle[$i] + $sequence_cle[$j]) % 256];

        // Déchiffrement en utilisant l'opération XOR
        $caractere_crypte = hexdec($message_crypte[$k] . $message_crypte[$k + 1]);
        $caractere_decrypte = $caractere_crypte ^ $tempKey;

        // Concaténation du caractère déchiffré au résultat final
        $message_decrypte.= chr($caractere_decrypte);
    }

    return $message_decrypte;
}


echo '<br>';
echo $cle;
echo '<br>';
echo $message;
echo '<br>';
echo RC4($cle,$message);
echo '<br>';
echo RC4_decrypt($cle,RC4($cle,$message));



?>