<?php

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
    header('HTTP/1.0 403 Forbidden');
    echo "Invalid signature";
}
?>
