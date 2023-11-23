<?php

<<<<<<< HEAD
$secret = '7c63002b24f5e597df3972f6ed974d1246564c07';
$payload = file_get_contents('php://input');
$githubSignature = $_SERVER['HTTP_X_HUB_SIGNATURE'] ?? '';

// Logging untuk debugging
file_put_contents('webhook.log', "Received GitHub Signature: " . $githubSignature . "\n", FILE_APPEND);

$signature = hash_hmac('sha1', $payload, $secret);

// Logging untuk debugging
file_put_contents('webhook.log', "Generated Local Signature: sha1=" . $signature . "\n", FILE_APPEND);

if (hash_equals('sha1=' . $signature, $githubSignature)) {
    shell_exec('/usr/local/bin/update-maigroup.sh');
    file_put_contents('webhook.log', "Running shell command\n", FILE_APPEND);
    echo "Webhook received and processed";
} else {
=======
// Secret token untuk memvalidasi webhook dari GitHub
$secret = 'B6843E0D3EBA394B';

// Mendapatkan payload dari GitHub
$payload = file_get_contents('php://input');

// Mendapatkan signature dari header request
$githubSignature = $_SERVER['HTTP_X_HUB_SIGNATURE'] ?? '';

// Membuat signature lokal untuk validasi
$signature = hash_hmac('sha1', $payload, $secret);

// Membandingkan signature lokal dengan signature dari GitHub
if (hash_equals('sha1=' . $signature, $githubSignature)) {
    // Jika valid, jalankan script update
    shell_exec('/usr/local/bin/update-maigroup.sh');
    echo "Webhook received and processed";
} else {
    // Jika tidak valid, kirimkan respon gagal
>>>>>>> 26d8dd96160a94942e4c9278d1d654a083a9e245
    header('HTTP/1.0 403 Forbidden');
    echo "Invalid signature";
}
?>
