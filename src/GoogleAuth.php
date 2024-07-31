<?php

declare(strict_types=1);

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

    /**
     * Get the URL for user authentication
     */
    public function getAuthUrl(): string
    {
        return $this->googleClient->createAuthUrl();
    }

    /**
     * Get the access token using the code
     */
    public function getAccessToken(string $code): string
    {
        $res = $this->googleClient->fetchAccessTokenWithAuthCode($code);
        return $res['access_token'];
    }

    /**
     * Set the access token to the Google client
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->googleClient->setAccessToken($accessToken);
    }
}
