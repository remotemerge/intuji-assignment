<?php

declare(strict_types=1);

use Intuji\Events\GoogleAuth;
use Intuji\Events\GoogleCalendar;

// Bootstrap the application
require dirname(__DIR__) . '/bootstrap/app.php';

// Get the Google client
$client = (new GoogleAuth())->getClient();

// Access token is expired
if ($client->isAccessTokenExpired()) {
    unset($_SESSION['access_token']);
}

// Init events
$events = [];

// Access token is available
if (isset($_SESSION['access_token'])) {
    $calendarId = 'primary';
    $calendar = new GoogleCalendar();
    $events = $calendar->getEvents($calendarId);
}
