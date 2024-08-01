<?php

declare(strict_types=1);

// Bootstrap the application
require dirname(__DIR__) . '/bootstrap/app.php';

// Start the session
session_start();

// Get the Google client
$client = (new Intuji\Events\GoogleAuth())->getClient();

// Access token is available
if (isset($_SESSION['access_token'])) {
    // Set the access token
    $client->setAccessToken($_SESSION['access_token']);

    // Revoke the access token
    $client->revokeToken();

    // Unset the access token
    unset($_SESSION['access_token']);
}

// Redirect to the home page
header('Location: /');
