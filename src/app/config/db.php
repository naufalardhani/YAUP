<?php

$environment = getenv('APP_ENV') ?: 'development';

if ($environment == 'development') {
    $dsn = 'sqlite:///tmp/app.db';
} else {
    $host = '127.0.0.1';
    $db = 'yaup';
    $user = 'postgres';
    $password = 'postgres';
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$user;password=$password";
}

try {
    $pdo = new PDO($dsn);
} catch (PDOException $e) {
    die($e->getMessage());
}
