<?php


namespace Helpers;

class OAuth2Helper
{
    const APP_REQUIRED_SCOPES = ['contacts'];
    const CALLBACK_PATH = '/oauth/callback.php';

    public static function getClientId() {
        $clientId = $_ENV['HUBSPOT_CLIENT_ID'];
        if (empty($clientId)) {
            throw new \Exception("Please specify HUBSPOT_CLIENT_ID in .env");
        }

        return $clientId;
    }

    public static function getClientSecret() {
        $clientSecret = $_ENV['HUBSPOT_CLIENT_SECRET'];
        if (empty($clientSecret)) {
            throw new \Exception("Please specify HUBSPOT_CLIENT_SECRET in .env");
        }

        return $clientSecret;
    }

    public static function getRedirectUri() {
        return UrlHelper::generateServerUri().self::CALLBACK_PATH;
    }

    public static function getScope() {
        return self::APP_REQUIRED_SCOPES;
    }

    public static function saveTokens($tokens) {
        $tokens['expires_at'] = time() + $tokens['expires_in'] * 0.95;
        $_SESSION['tokens'] = $tokens;
    }

    public static function refreshAndGetAccessToken() {
        if (empty($_SESSION['tokens'])) {
            throw new \Exception("Please authorize via OAuth2");
        }

        $tokens = $_SESSION['tokens'];

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
