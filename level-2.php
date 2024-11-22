<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encrypt & Decrypt Text</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .copyable {
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-sm">
        <h1 class="text-2xl font-bold mb-4 text-center">Encrypt & Decrypt Text</h1>
        <form method="post">
            <div class="mb-4">
                <label for="text" class="block text-gray-700">Text:</label>
                <input type="text" id="text" name="text" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="key" class="block text-gray-700">Key:</label>
                <input type="text" id="key" name="key" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="iv" class="block text-gray-700">IV:</label>
                <input type="text" id="iv" name="iv" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <button type="submit" name="action" value="encrypt" class="w-full bg-blue-500 text-white p-2 rounded">Encrypt</button>
            <button type="submit" name="action" value="decrypt" class="w-full bg-green-500 text-white p-2 rounded mt-2">Decrypt</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            function encrypt($plaintext, $key, $iv) {
                return openssl_encrypt($plaintext, 'aes-256-cbc', $key, 0, $iv);
            }

            function decrypt($ciphertext, $key, $iv) {
                return openssl_decrypt($ciphertext, 'aes-256-cbc', $key, 0, $iv);
            }

            $text = $_POST['text'];
            $key = $_POST['key'];
            $iv = $_POST['iv'];
            
            if (strlen($iv) !== 16) {
                $iv = str_pad($iv, 16, "\0"); // Pad the IV to 16 bytes if needed
            }

            $action = $_POST['action'];

            if ($action === 'encrypt') {
                $encryptedText = encrypt($text, $key, $iv);
                echo "Encrypted Text: \n";
                echo "<p class='mt-4 copyable' onclick='copyToClipboard(this)'><span class='font-mono bg-gray-100 p-2 rounded'>{$encryptedText}</span></p>";
            } elseif ($action === 'decrypt') {
                $decryptedText = decrypt($text, $key, $iv);
                echo "Decrypted Text: \n";
                echo "<p class='mt-4 copyable' onclick='copyToClipboard(this)'><span class='font-mono bg-gray-100 p-2 rounded'>{$decryptedText}</span></p>";
            }
        }
        ?>
    </div>

    <script>
        function copyToClipboard(element) {
            const text = element.innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert('Text copied to clipboard');
            }).catch(err => {
                alert('Failed to copy text: ' + err);
            });
        }
    </script>
</body>
</html>
