<?php
// Database configuration — update these values in cPanel > MySQL Databases
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_cpanel_username_rentals');
define('DB_USER', 'your_cpanel_username_dbuser');
define('DB_PASS', 'your_database_password');
define('DB_CHARSET', 'utf8mb4');

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log('Database connection failed: ' . $e->getMessage());
            die('Unable to connect to the database. Please contact the site administrator.');
        }
    }
    return $pdo;
}
