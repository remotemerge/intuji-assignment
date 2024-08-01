<?php

declare(strict_types=1);

// Bootstrap the application
require dirname(__DIR__) . '/bootstrap/app.php';

// Code available
if (isset($_GET['code'])) {
    // Get the access token
    $accessToken = (new Intuji\Events\GoogleAuth())->getAccessToken($_GET['code']);
    $_SESSION['access_token'] = $accessToken;
}

// Redirect to the home page
header('Location: /');
