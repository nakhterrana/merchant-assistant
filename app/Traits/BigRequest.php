<?php

namespace App\Http\Traits;

use App\Helpers\Constants;
use GuzzleHttp\Client;

trait BigRequest
{
    use BigAuth;

    /**
     * Method sendRequest
     *
     * @param string $method 
     * @param int $version
     * @param int $storePass
     * @param int $storeHash
     * @param string $endpoint
     *
     * @return array
     */
    public function sendRequest(string $method, int $version, int $storePass, int $storeHash, string $endpoint): array
    {
        $requestConfig = [
            'headers' => [
                'Accept' => 'application/json',
                'X-Auth-Client' => $this->getAppClientId(),
                'X-Auth-Token'  => $storePass,
                'Content-Type'  => 'application/json',
            ]
        ];

        $client = new Client();
        $url = Constants::BC_API_ENDPOINT . $storeHash . '/' . $version . '/' . $endpoint;
        $response = $client->request($method, $url, $requestConfig);
        return json_decode($response->getBody(), true);
    }
}
