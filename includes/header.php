<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? APP_NAME) ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="container">
        <a class="brand" href="<?= BASE_URL ?>"><?= htmlspecialchars(APP_NAME) ?></a>
        <nav>
            <a href="<?= BASE_URL ?>">Home</a>
            <a href="<?= BASE_URL ?>/listings">Listings</a>
            <a href="<?= BASE_URL ?>/contact">Contact</a>
        </nav>
    </div>
</header>
<main class="container">
