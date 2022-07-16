<?php


namespace brucebnu\store\tiktokshop;

use GuzzleHttp\Client as GuzzleClient;

trait HasAuthorization
{
    use HttpNode;

    private string $authHost = "https://auth.tiktok-shops.com";

    public function getAuthorizationUrl(): string
    {
        $params = [
            'app_key' => $this->appKey,
            'state' => $this->generateRandomStateString(),
        ];
        return $this->authHost . '/oauth/authorize?' . http_build_query($params);
    }

    private function generateRandomStateString(int $length = 8): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public function getAccessToken(string $code, $is_array = false)
    {
        $client = new GuzzleClient(['base_uri' => $this->authHost]);

        $response = $client->request('POST', '/api/token/getAccessToken', [
            'form_params' => [
                'app_key' => $this->appKey,
                'app_secret' => $this->appSecret,
                'auth_code' => $code,
                'grant_type' => 'authorized_code',
            ],
        ]);

        return json_decode($response->getBody()->getContents(), $is_array);
    }

    public function refreshAccessToken(string $refreshToken)
    {
        $client = new GuzzleClient(['base_uri' => $this->authHost]);

        $response = $client->request('POST', '/api/token/refreshToken', [
            'form_params' => [
                'app_key' => $this->appKey,
                'app_secret' => $this->appSecret,
                'refresh_token' => $refreshToken,
                'grant_type' => 'refresh_token',
            ],
        ]);

        return json_decode($response->getBody()->getContents(), $is_array = false);
    }
}
