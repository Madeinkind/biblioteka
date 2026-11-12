<?php
/**
 * Creates the SQLite database and its tables (safe to run multiple times).
 * Usage: php database/init.php
 */
$dbFile = __DIR__ . '/database.sqlite';

if (!file_exists($dbFile)) {
    touch($dbFile);
}

$pdo = new PDO('sqlite:' . $dbFile);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('PRAGMA foreign_keys = ON');

$schema = file_get_contents(__DIR__ . '/schema.sql');
$pdo->exec($schema);

echo 'Database ready: ' . $dbFile . PHP_EOL;
