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

// Get the Google Calendar service
$service = new Google_Service_Calendar($client);

// Create a new event
$event = new Google_Service_Calendar_Event();
$event->setSummary($_POST['summary']);
$event->setLocation($_POST['location'] ?? '');
$event->setDescription($_POST['description'] ?? '');

$start = new Google_Service_Calendar_EventDateTime();
$start->setDateTime(str_replace(' ', '', $_POST['start_date']) . ':00+05:45');
$event->setStart($start);

$end = new Google_Service_Calendar_EventDateTime();
$end->setDateTime(str_replace(' ', '', $_POST['end_date']) . ':59+05:45');
$event->setEnd($end);

$calendar = new Intuji\Events\GoogleCalendar();
$event = [
    'summary' => $_POST['summary'],
    'location' => $_POST['location'] ?? '',
    'description' => $_POST['description'] ?? '',
    'start' => [
        'dateTime' => str_replace(' ', '', $_POST['start_date']) . ':00+05:45',
        'timeZone' => 'Asia/Kathmandu',
    ],
    'end' => [
        'dateTime' => str_replace(' ', '', $_POST['end_date']) . ':59+05:45',
        'timeZone' => 'Asia/Kathmandu',
    ],
];

// Insert the event
try {
    $event = $calendar->createEvent($event);
    if ($event) {
        $_SESSION['success'] = 'The event has been added successfully.';
    }
} catch (\Google\Service\Exception $e) {
    // Print the error message
    echo $e->getMessage();
    exit;
}

// Redirect to the home page
header('Location: /');
