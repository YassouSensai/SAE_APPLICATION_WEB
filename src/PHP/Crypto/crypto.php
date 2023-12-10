<?php
#Génération de la suite chiffrante de RC4 ou Pseudo Random Generator Algorithm PRGA
function RC4($cle ,$message) {
    $keyStream = initialize($cle);
    $message_crypte = '';

    $i = 0;
    $j = 0;

    for ($k = 0; $k < strlen($message); $k++) {
       $i = ($i + 1) % 256;
       $j = ($j + $keyStream[$i]) % 256;

       // Swap
       $temp = $keyStream[$i];
       $keyStream[$i] = $keyStream[$j];
       $keyStream[$j] = $temp;

       $tempKey = $keyStream[($keyStream[$i] + $keyStream[$j]) % 256];
       $message_crypte .= $message[$k] ^ $tempKey;
    }
}

?>