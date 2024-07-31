<?php

declare(strict_types=1);

namespace Intuji\Events;

use Google\Service\Exception;
use Google_Service_Calendar;

final class GoogleCalendar
{
    /**
     * Get the events from the Google Calendar
     * @throws Exception
     */
    public function getEvents($calendarId = 'primary', $maxResults = 10): array
    {
        // Get the Google client
        $client = (new GoogleAuth())->getClient();
        $client->setAccessToken($_SESSION['access_token']);

        // Get the Google Calendar service
        $service = new Google_Service_Calendar($client);

        // Get the events
        $results = $service->events->listEvents($calendarId, [
            'maxResults' => $maxResults,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'),
        ]);

        return $results->getItems();
    }
}
