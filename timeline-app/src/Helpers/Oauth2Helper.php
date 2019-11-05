<?php


namespace Helpers;

use Oauth\HubspotOauth2Client;

class Oauth2Helper
{
    const APP_REQUIRED_SCOPE = ['contacts', 'timeline'];
    const CALLBACK_PATH = '/oauth/callback.php';
    const SESSION_TOKENS_KEY = 'tokens';

    private static $hubSpotOauth2Client = null;

    public static function getHubspotOauth2Client() {
        if (!self::$hubSpotOauth2Client) {
            self::$hubSpotOauth2Client = new HubspotOauth2Client([
                'clientId' => getEnvOrException('HUBSPOT_CLIENT_ID'),
                'clientSecret' => getEnvOrException('HUBSPOT_CLIENT_SECRET'),
                'redirectUri' => UrlHelper::generateServerUri().self::CALLBACK_PATH,
                'scope' => self::APP_REQUIRED_SCOPE,
            ]);
        }
        return self::$hubSpotOauth2Client;
    }

    public static function isAuthenticated() {
        return isset($_SESSION[self::SESSION_TOKENS_KEY]);
    }

    public static function saveTokens($tokens) {
        $tokens['expires_at'] = time() + $tokens['expires_in'] * 0.95;
        $_SESSION[self::SESSION_TOKENS_KEY] = $tokens;
    }

    public static function refreshAndGetAccessToken() {
        if (empty($_SESSION['tokens'])) {
            throw new \Exception("Please authorize via OAuth2");
        }

        $tokens = $_SESSION[self::SESSION_TOKENS_KEY];
        if (time() > $tokens['expires_at']) {
            $oauth2Client = self::getHubspotOauth2Client();
            $tokens = $oauth2Client->refreshToken($tokens['refresh_token']);
            self::saveTokens($tokens);
        }

        return $tokens['access_token'];
    }
}
