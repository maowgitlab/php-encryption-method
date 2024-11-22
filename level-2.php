<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encrypt Text</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-sm">
        <h1 class="text-2xl font-bold mb-4 text-center">Encrypt Text</h1>
        <form method="post">
            <div class="mb-4">
                <label for="text" class="block text-gray-700">Text:</label>
                <input type="text" id="text" name="text" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="key" class="block text-gray-700">Key:</label>
                <input type="text" id="key" name="key" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Encrypt</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            function encrypt($plaintext, $key, $iv) {
                return openssl_encrypt($plaintext, 'aes-256-cbc', $key, 0, $iv);
            }

            $text = $_POST['text'];
            $key = $_POST['key'];
            $iv = openssl_random_pseudo_bytes(16);
            $encryptedText = encrypt($text, $key, $iv);

            echo "<p class='mt-4'>Encrypted Text: <span class='font-mono bg-gray-100 p-2 rounded'>{$encryptedText}</span></p>";
        }
        ?>
    </div>
</body>
</html>
