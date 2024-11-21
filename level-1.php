<?php 
    function encrypt($plaintext, $key, $iv)
    {
        return openssl_encrypt($plaintext, 'aes-256-cbc', $key, 0, $iv);
    }