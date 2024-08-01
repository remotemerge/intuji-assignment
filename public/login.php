<?php

declare(strict_types=1);

// Bootstrap the application
require dirname(__DIR__) . '/bootstrap/app.php';

// Get the Google client
$client = (new Intuji\Events\GoogleAuth())->getClient();

// Access token is not available
if (!isset($_SESSION['access_token'])) {
    //  Redirect to login page
    $authUrl = (new Intuji\Events\GoogleAuth())->getAuthUrl();
    header('Location: ' . $authUrl);
}

// Check if access token is expired
if ($client->isAccessTokenExpired()) {
    // Refresh the access token
    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    $_SESSION['access_token'] = $client->getAccessToken();
}

// Redirect to the home page
header('Location: /');
