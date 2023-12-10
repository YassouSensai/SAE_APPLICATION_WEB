<?php
# Génération de la suite chiffrante de RC4 ou Pseudo Random Generator Algorithm PRGA
$message = 'Hello World';
$cle = 'test';

function initialize($key) {
    $keyLength = strlen($key);
    $keyStream = range(0, 255);

    $j = 0;
    for ($i = 0; $i < 256; $i++) {
        $j = ($j + $keyStream[$i] + ord($key[$i % $keyLength])) % 256;

        // Swap
        $temp = $keyStream[$i];
        $keyStream[$i] = $keyStream[$j];
        $keyStream[$j] = $temp;
    }

    return $keyStream;
}

function RC4($cle, $message)
{
    $keyStream = initialize($cle);
    //echo gettype($keyStream);
    $message_crypte = '';

    $i = 0;
    $j = 0;

    for ($k = 0; $k < strlen($message); $k++) {
        $i = ($i + 1) % 256;
        $j = ($j + $keyStream[$i]) % 256;

        $temp = $keyStream[$i];
        $keyStream[$i] = $keyStream[$j];
        $keyStream[$j] = $temp;

        $tempKey = $keyStream[($keyStream[$i] + $keyStream[$j]) % 256];
        $message_crypte = $message_crypte.($message[$k].$tempKey);
    }
    return ($message_crypte);
}

echo (RC4($cle, $message));

echo '<br>';
echo $cle;
echo '<br>';
echo $message;
?>