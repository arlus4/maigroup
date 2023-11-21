<?php

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
    header('HTTP/1.0 403 Forbidden');
    echo "Invalid signature";
}
?>
