<?php


namespace Oauth;

class HubspotOauth2Client
{
    const AUTHORIZE_URL = "https://app.hubspot.com/oauth/authorize";
    const TOKEN_URL = "https://api.hubapi.com/oauth/v1/token";
    const APP_REQUIRED_SCOPE = "contacts";

    protected $clientId;
    protected $clientSecret;
    protected $redirectUri;
    protected $scope;

    /**
     * HubspotOauth2Client constructor.
     * @param $params
     */
    public function __construct($params) {
        $this->clientId = $params['clientId'];
        $this->clientSecret = $params['clientSecret'];
        $this->redirectUri = $params['redirectUri'];
        $this->scope = $params['scope'];
    }

    public function getAuthorizationUrl() {
        return self::AUTHORIZE_URL.'?'.http_build_query([
            'client_id' => $this->clientId,
            'scope' => $this->scope,
            'redirect_uri' => $this->redirectUri
        ]);
    }

    public function getAccessToken($code) {
        $authCodeProof = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'code' => $code,
        ];
        $tokens = (array)json_decode($this->httpPost(self::TOKEN_URL, $authCodeProof));
        if (!isset($tokens['access_token'])) {
            var_dump($tokens);
            exit();
        }
        return $tokens['access_token'];
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
