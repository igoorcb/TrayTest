<?php

namespace App\Services\Google;

use Google\Client;
use Google\Service\Oauth2;

class GoogleAuthService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId(config('services.google.client_id'));
        $this->client->setClientSecret(config('services.google.client_secret'));
        $this->client->setRedirectUri(config('services.google.redirect'));
        $this->client->addScope('email');
        $this->client->addScope('profile');
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');
    }

    public function getAuthUrl(): string
    {
        return $this->client->createAuthUrl();
    }

    public function fetchAccessTokenWithCode(string $code): array
    {
        return $this->client->fetchAccessTokenWithAuthCode($code);
    }

    public function getUserInfo(string $accessToken): ?array
    {
        $this->client->setAccessToken($accessToken);
        $oauth2 = new Oauth2($this->client);
        $userInfo = $oauth2->userinfo->get();

        return [
            'email' => $userInfo->email,
            'name' => $userInfo->name,
            'avatar' => $userInfo->picture,
        ];
    }
}
