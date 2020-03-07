<?php

namespace App\Services;

use GuzzleHttp\Client;

class BackApiService
{
    private $guzzleClient;
    private $apiConfig;

    /**
     * constructor
     * @param Client $guzzleClient
     */
    public function __construct(
        Client $guzzleClient
    ) {
        $this->guzzleClient = $guzzleClient;
        $this->apiConfig = config('apiback');
    }

    /**
     * get to an api endpoint
     * @param string $method
     * @param string $entity
     * @param string $action
     * @param array $params
     * @return array $responseArray
     */
    public function requestApi(
        string $method,
        string $entity,
        string $action,
        array $params = []
    ) : array {
        $url = $this->apiConfig['url'];
        $token = $this->apiConfig['token'];
        $secret = $this->apiConfig['secret'];

        $response = $this->guzzleClient->request(
            $method,
            $url.$entity.'/'.$action,
            [
                'headers' => [
                    'token' => $token,
                    'secret' => $secret,
                ],
                'form_params' => $params,
                'http_errors' => false,
            ]
        );
        
        $responseJson = (string) $response->getBody();
        $responseArray = json_decode($responseJson, true);
        $responseArray['http_code'] = $response->getStatusCode();
        return $responseArray;
    }
}
