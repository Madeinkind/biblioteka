<?php
/**
 * Generates an RSA key pair and writes it to public/api/.env.
 * Usage: php scripts/generate_jwt_keys.php
 */
$envFile = dirname(__DIR__) . '/.env';

$res = openssl_pkey_new([
    'private_key_bits' => 1024,
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
]);

if ($res === false) {
    fwrite(STDERR, 'Failed to generate a key pair: ' . openssl_error_string() . PHP_EOL);
    exit(1);
}

openssl_pkey_export($res, $privateKey);
$publicKey = openssl_pkey_get_details($res)['key'];

$privateValue = '"' . str_replace(["\r\n", "\n"], '\n', $privateKey) . '"';
$publicValue = '"' . str_replace(["\r\n", "\n"], '\n', $publicKey) . '"';

if (!file_exists($envFile)) {
    fwrite(STDERR, 'File not found: ' . $envFile . PHP_EOL);
    fwrite(STDERR, 'Copy .env.example to .env first.' . PHP_EOL);
    exit(1);
}

$lines = file($envFile, FILE_IGNORE_NEW_LINES);
$foundPrivate = false;
$foundPublic = false;

foreach ($lines as $i => $line) {
    if (strpos($line, 'JWT_PRIVATE_KEY=') === 0) {
        $lines[$i] = 'JWT_PRIVATE_KEY=' . $privateValue;
        $foundPrivate = true;
    } elseif (strpos($line, 'JWT_PUBLIC_KEY=') === 0) {
        $lines[$i] = 'JWT_PUBLIC_KEY=' . $publicValue;
        $foundPublic = true;
    }
}

if (!$foundPrivate) {
    $lines[] = 'JWT_PRIVATE_KEY=' . $privateValue;
}
if (!$foundPublic) {
    $lines[] = 'JWT_PUBLIC_KEY=' . $publicValue;
}

file_put_contents($envFile, implode(PHP_EOL, $lines) . PHP_EOL);

echo 'JWT keys written to ' . $envFile . PHP_EOL;
