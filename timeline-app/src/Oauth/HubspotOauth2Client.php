<?php


namespace Oauth;

use Helpers\HubspotClientHelper;

class HubspotOauth2Client
{
    const AUTHORIZE_URL = "https://app.hubspot.com/oauth/authorize";
    const TOKEN_URL = "https://api.hubapi.com/oauth/v1/token";

    protected $clientId;
    protected $clientSecret;
    protected $redirectUri;
    protected $scope;
    protected $oauth;

    /**
     * HubspotOauth2Client constructor.
     * @param $params
     */
    public function __construct($params) {
        $this->clientId = $params['clientId'];
        $this->clientSecret = $params['clientSecret'];
        $this->redirectUri = $params['redirectUri'];
        $this->scope = $params['scope'];
        $this->oauth = HubspotClientHelper::createFactoryForOauth()->oAuth2();
    }

    public function getAuthorizationUrl() {
        return $this->oauth->getAuthUrl($this->clientId, $this->redirectUri, $this->scope);
    }

    public function getTokens($code) {
        $proof = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'code' => $code,
        ];
        $tokens = (array)json_decode($this->httpPost(self::TOKEN_URL, $proof));
        return $tokens;
    }

    public function refreshToken($refreshToken) {
        $proof = [
            'grant_type' => 'refresh_token',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'refresh_token' => $refreshToken,
        ];
        $tokens = (array)json_decode($this->httpPost(self::TOKEN_URL, $proof));
        return $tokens;
    }

    protected function httpPost($url, $data) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
