<?php

declare(strict_types=1);

// Bootstrap the application
require dirname(__DIR__) . '/bootstrap/app.php';

// Get the Google client
$client = (new Intuji\Events\GoogleAuth())->getClient();

// Access token is expired
if ($client->isAccessTokenExpired()) {
    unset($_SESSION['access_token']);
}

// Access token is not available
if (!isset($_SESSION['access_token'])) {
    //  Redirect to login page
    $authUrl = (new Intuji\Events\GoogleAuth())->getAuthUrl();
    header('Location: ' . $authUrl);
} else {
    // Redirect to the home page
    header('Location: /');
}
