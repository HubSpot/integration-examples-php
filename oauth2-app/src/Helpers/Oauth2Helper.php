<?php


namespace Helpers;

use Oauth\HubspotOauth2Client;

class Oauth2Helper
{
    const APP_REQUIRED_SCOPE = "contacts";

    public static function getHubspotOauth2Client() {
        return new HubspotOauth2Client([
            'clientId' => $_ENV['HUBSPOT_CLIENT_ID'],
            'clientSecret' => $_ENV['HUBSPOT_CLIENT_SECRET'],
            'redirectUri' => UrlHelper::generateServerUri().'/oauth/callback.php',
            'scope' => self::APP_REQUIRED_SCOPE,
        ]);
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
            $oauth2Client = self::getHubspotOauth2Client();
            $tokens = $oauth2Client->refreshToken($tokens['refresh_token']);
            self::saveTokens($tokens);
        }

        return $tokens['access_token'];
    }
}
