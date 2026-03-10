<?php
// Application-wide constants
define('APP_NAME', 'MY PHP Rental');
define('APP_VERSION', '1.0.0');
define('BASE_URL', 'https://yourdomain.com'); // Update with your actual domain

// Path constants
define('ROOT_PATH', __DIR__ . '/..');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('PAGES_PATH', ROOT_PATH . '/pages');

// Timezone
date_default_timezone_set('Asia/Dhaka');

// Error reporting (set to 0 on production)
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
