<?php

declare(strict_types=1);

// Bootstrap the application
require dirname(__DIR__) . '/bootstrap/app.php';

// Get the Google client
$client = (new Intuji\Events\GoogleAuth())->getClient();

// Not post request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Redirect to home page
    header('Location: /');
}

// Access token is not available
if (!isset($_SESSION['access_token'])) {
    //  Redirect to home page
    header('Location: /');
}

// Access token is expired
if ($client->isAccessTokenExpired()) {
    unset($_SESSION['access_token']);
    // Redirect to home page
    header('Location: /');
}

// Delete the event
try {
    $calendar = new Intuji\Events\GoogleCalendar();
    $calendar->deleteEvent($_POST['id']);
    $_SESSION['success'] = 'The event has been deleted successfully.';
} catch (\Google\Service\Exception $exception) {
    // Print the error message
    echo $exception->getMessage();
    exit;
}

// Redirect to the home page
header('Location: /');
