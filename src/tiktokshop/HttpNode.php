<?php


namespace brucebnu\store\tiktokshop;


use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;

trait HttpNode
{
    protected string $api_path = '/api';

    private function getClient()
    {
        return new GuzzleClient(['base_uri' => $this->client->apiHost]);
    }

    protected function get($uri, array $params = [], $is_array=false)
    {
        $response = $this->getClient()->request('GET', $this->getPath($uri), [
            RequestOptions::QUERY => $this->getParameters($uri, $params),
        ]);

        $response = new Response($response, $params);

        return $response->object($is_array);
    }

    protected function post($uri, array $params = [], $is_array=false)
    {
        // dd($params);
        $response = $this->getClient()->request('POST', $this->getPath($uri), [
            RequestOptions::QUERY => $this->getParameters($uri),
            RequestOptions::JSON => $params,
        ]);

        $response = new Response($response, $params);

        return $response->object($is_array);
    }

    protected function put($uri, array $params = [])
    {
        $response = $this->getClient()->request('PUT', $this->getPath($uri), [
            RequestOptions::QUERY => http_build_query($this->getParameters($uri, $params)),
            RequestOptions::JSON => $params,
        ]);

        $response = new Response($response, $params);

        return $response->object();
    }

    // delete Access level to brucebnu\store\tiktokshop\HasAuthorization::delete() must be public (as in class yii\db\ActiveRecord)
    protected function httpDelete($uri, array $params = [])
    {
        $response = $this->getClient()->request('POST', $this->getPath($uri), [
            RequestOptions::QUERY => $this->getParameters($uri),
            RequestOptions::JSON => $params,
        ]);

        $response = new Response($response, $params);

        return $response->object();
    }

    private function getPath($uri): string
    {
        return $this->api_path . $this->getNodeEndpoint() . $uri;
    }

    private function getParameters($uri, array $params = [])
    {
        $params = array_merge($params, [
            'app_key' => $this->client->appKey,
            'access_token' => $this->client->accessToken,
            'shop_id' => $this->client->shopId,
            'timestamp' => time(),
        ]);

        $params['sign'] = $this->generateSignature($uri, $params);

        return $params;
    }

    private function generateSignature($uri, $params)
    {
        // secret
        $secret = $this->client->appSecret;
//                print_r(json_encode($params)); die();

        // merge timestamp
        $params = array_diff_key($params, ['sign' => '', 'access_token' => '']);

        // Sort parameters
        ksort($params);

        $sign_string = $secret . $this->getPath($uri) . $this->buildParameterString($params) . $secret;

//        print_r($sign_string); die();
        return hash_hmac('sha256', $sign_string, $secret);
    }

    private function buildParameterString($params)
    {
        $string = '';

        foreach ($params as $key => $value) {
            if (is_array($value)) {
//                print_r($value);die();
//                $string .= $this->buildParameterString($value);
//                print_r($string); die();
            } else {
                $string .= $key . $value;
            }
        }

        return $string;
    }
}
