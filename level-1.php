<?php 
    function encrypt($plaintext, $key, $iv)
    {
        return openssl_encrypt($plaintext, 'aes-256-cbc', $key, 0, $iv);
    }

    function decrypt($ciphertext, $key, $iv)
    {
        return openssl_decrypt($ciphertext, 'aes-256-cbc', $key, 0, $iv);
    }

    $key = "12345secretKey";
    $iv = openssl_random_pseudo_bytes(16);

    $plaintext = "Hello, World!";
    $ciphertext = encrypt($plaintext, $key, $iv);
    echo "Encrypted: " . $ciphertext . "\n";

    $decrypted = decrypt($ciphertext, $key, $iv);
    echo "Decrypted: " . $decrypted . "\n";