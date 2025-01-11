<?php

namespace App\Services;

use Google\Client;
use Google\Service\Calendar;
use Google\Service\Oauth2;

class GoogleClientService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(storage_path('app/google/client_secret.json'));
        $this->client->addScope([
            Calendar::CALENDAR,
            Oauth2::USERINFO_PROFILE,
            Oauth2::USERINFO_EMAIL,
        ]);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
    }

    public function getAuthUrl()
    {
        return $this->client->createAuthUrl();
    }

    public function fetchAccessTokenWithAuthCode($code)
    {
        return $this->client->fetchAccessTokenWithAuthCode($code);
    }

    public function setAccessToken($token)
    {
        $this->client->setAccessToken($token);

        if ($this->client->isAccessTokenExpired()) {
            $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
        }
    }

    public function getCalendarService()
    {
        return new Calendar($this->client);
    }

    public function getUserInfo($accessToken)
    {
        $this->client->setAccessToken($accessToken);
        $oauth2Service = new Oauth2($this->client);

        return $oauth2Service->userinfo->get();
    }
}
