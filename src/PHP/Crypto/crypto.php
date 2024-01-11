<?php

#crée une séquence à partir de la clé de crytpage recu en parametre
function initialize($cle) {
    $longueur_cle = strlen($cle);
    $sequence_cle = range(0, 255);
    $j = 0;

    for ($i = 0; $i < 256; $i++) {
        $j = ($j + $sequence_cle[$i] + ord($cle[$i % $longueur_cle])) % 256;

        // échange des valeurs
        $temp = $sequence_cle[$i];
        $sequence_cle[$i] = $sequence_cle[$j];
        $sequence_cle[$j] = $temp;
    }
    return $sequence_cle;
}


function RC4($cle, $message)
{
    //initialisation de la séquence de cle
    $sequence_cle = initialize($cle);
    $message_crypte = '';

    $i = 0;
    $j = 0;

    // boucle pour parcourir le message à crypter
    for ($k = 0; $k < strlen($message); $k++) {
        $i = ($i + 1) % 256;
        $j = ($j + $sequence_cle[$i]) % 256;

        // échange de place des valeurs $sequence_cle[$i] et $sequence_cle[$j]
        $temp = $sequence_cle[$i];
        $sequence_cle[$i] = $sequence_cle[$j];
        $sequence_cle[$j] = $temp;

        $tempKey = $sequence_cle[($sequence_cle[$i] + $sequence_cle[$j]) % 256];

        // Chiffrement en utilisant l'opération XOR et conversion en hexadécimal
        $caractere_crypte = ord($message[$k]) ^ $tempKey; //la fonction ord permet d obtenir le code en hexadecimal du caractere code dans la table ASCII

        $message_crypte .= sprintf("%02X", $caractere_crypte);
    }

    return $message_crypte;
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

?>
