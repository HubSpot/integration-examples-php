<?php

namespace Helpers;

use Repositories\TokensRepository;

class OAuth2Helper
{
    const APP_REQUIRED_SCOPES = ['contacts', 'forms'];
    const CALLBACK_PATH = '/oauth/callback.php';

    public static function getClientId(): string
    {
        $clientId = $_ENV['HUBSPOT_CLIENT_ID'];
        if (empty($clientId)) {
            throw new \Exception('Please specify HUBSPOT_CLIENT_ID in .env');
        }

        return $clientId;
    }

    public static function getClientSecret(): string
    {
        $clientSecret = $_ENV['HUBSPOT_CLIENT_SECRET'];
        if (empty($clientSecret)) {
            throw new \Exception('Please specify HUBSPOT_CLIENT_SECRET in .env');
        }

        return $clientSecret;
    }

    public static function getRedirectUri(): string
    {
        return UrlHelper::generateServerUri().self::CALLBACK_PATH;
    }

    public static function getScope(): array
    {
        return self::APP_REQUIRED_SCOPES;
    }

    public static function getExpiresAt(int $expiresIn): int
    {
        return time() + $expiresIn * 0.95;
    }

    public static function isAuthenticated(): bool
    {
        return !empty(TokensRepository::getToken());
    }

    public static function refreshAndGetAccessToken(): string
    {
        $tokens = TokensRepository::getToken();

        if (empty($tokens)) {
            throw new \Exception('Please authorize via OAuth2');
        }
        if (time() > $tokens['expires_at']) {
            $tokens = HubspotClientHelper::getOAuth2Resource()->getTokensByRefresh(
                self::getClientId(),
                self::getClientSecret(),
                $tokens['refresh_token']
            )->toArray();
            TokensRepository::save($tokens);
        }

        return $tokens['access_token'];
    }
}
