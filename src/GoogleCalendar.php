<?php

declare(strict_types=1);

namespace Intuji\Events;

use Google\Service\Exception;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

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

    /**
     * Create an event in the Google Calendar
     * @throws Exception
     */
    public function createEvent(array $event, $calendarId = 'primary'): bool
    {
        // Get the Google client
        $client = (new GoogleAuth())->getClient();
        $client->setAccessToken($_SESSION['access_token']);

        // Get the Google Calendar service
        $service = new Google_Service_Calendar($client);

        // Create the event
        $event = new Google_Service_Calendar_Event($event);
        $res = $service->events->insert($calendarId, $event);

        return $res->status === 'confirmed';
    }

    /**
     * Delete an event from the Google Calendar
     * @throws Exception
     */
    public function deleteEvent($eventId, $calendarId = 'primary'): bool
    {
        // Get the Google client
        $client = (new GoogleAuth())->getClient();
        $client->setAccessToken($_SESSION['access_token']);

        // Get the Google Calendar service
        $service = new Google_Service_Calendar($client);

        // Delete the event
        $res = $service->events->delete($calendarId, $eventId);

        return $res->status === 'confirmed';
    }
}
