<?php
declare(strict_types=1);

// Bootstrap application
require_once __DIR__ . '/config/config.php';

// Simple front-controller router
$url = trim($_GET['url'] ?? '', '/');

switch ($url) {
    case '':
    case 'home':
        require_once PAGES_PATH . '/home.php';
        break;

    case 'listings':
        require_once PAGES_PATH . '/listings.php';
        break;

    case 'contact':
        require_once PAGES_PATH . '/contact.php';
        break;

    default:
        http_response_code(404);
        $pageTitle = '404 Not Found — ' . APP_NAME;
        require_once INCLUDES_PATH . '/header.php';
        echo '<h2 style="color:#c0392b">404 — Page Not Found</h2>';
        echo '<p><a href="' . BASE_URL . '">Go back home</a></p>';
        require_once INCLUDES_PATH . '/footer.php';
        break;
}
