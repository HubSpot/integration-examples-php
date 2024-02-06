<?php

namespace Helpers;

class OAuth2Helper
{
    public const APP_REQUIRED_SCOPES = ['crm.objects.companies.read', 'crm.objects.companies.write'];
    public const CALLBACK_PATH = '/oauth/callback';
    public const SESSION_TOKENS_KEY = 'tokens';

    public static function getClientId(): string
    {
        return getEnvOrException('HUBSPOT_CLIENT_ID');
    }

    public static function getClientSecret(): string
    {
        return getEnvOrException('HUBSPOT_CLIENT_SECRET');
    }

    public static function getRedirectUri(): string
    {
        return UrlHelper::generateServerUri().self::CALLBACK_PATH;
    }

    public static function getScope(): array
    {
        return static::APP_REQUIRED_SCOPES;
    }

    public static function saveTokens(array $tokens): void
    {
        $tokens['expires_at'] = time() + $tokens['expires_in'] * 0.95;
        $_SESSION[static::SESSION_TOKENS_KEY] = $tokens;
    }

    public static function isAuthenticated(): bool
    {
        return isset($_SESSION[static::SESSION_TOKENS_KEY]);
    }

    public static function refreshAndGetAccessToken(): string
    {
        if (empty($_SESSION[static::SESSION_TOKENS_KEY])) {
            throw new \Exception('Please authorize via OAuth2');
        }

        $tokens = $_SESSION[static::SESSION_TOKENS_KEY];

        if (time() > $tokens['expires_at']) {
            $tokens = HubspotClientHelper::getOAuth2Resource()->getTokensByRefresh(
                self::getClientId(),
                self::getClientSecret(),
                $tokens['refresh_token']
            )->toArray();
            self::saveTokens($tokens);
        }

        return $tokens['access_token'];
    }
}
