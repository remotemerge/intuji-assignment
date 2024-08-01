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

// Get the Google Calendar service
$service = new Google_Service_Calendar($client);

// Create a new event
$event = new Google_Service_Calendar_Event();
$event->setSummary($_POST['summary']);
$event->setLocation($_POST['location'] ?? '');
$event->setDescription($_POST['description'] ?? '');

$start = new Google_Service_Calendar_EventDateTime();
$start->setDateTime($_POST['start_date'] . 'T00:00:00+05:45');
$event->setStart($start);

$end = new Google_Service_Calendar_EventDateTime();
$end->setDateTime($_POST['end_date'] . 'T23:59:59+05:45');
$event->setEnd($end);

// Insert the event
try {
    $event = $service->events->insert('primary', $event);
    if ($event && $event->getId()) {
        $_SESSION['success'] = 'Event added successfully.';
    }
} catch (\Google\Service\Exception $e) {
    // Print the error message
    echo $e->getMessage();
    exit;
}

// Redirect to the home page
header('Location: /');
