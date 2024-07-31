<?php

namespace Intuji\Events;

use Google_Client;
use Google_Service_Calendar;

final class GoogleAuth
{
    private Google_Client $googleClient;

    public function __construct()
    {
        $this->googleClient = new Google_Client();

        // Set credentials
        $this->googleClient->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $this->googleClient->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $this->googleClient->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);

        // Add scopes
        $this->googleClient->addScope(Google_Service_Calendar::CALENDAR_READONLY);
        $this->googleClient->addScope(Google_Service_Calendar::CALENDAR_EVENTS);
    }
}
