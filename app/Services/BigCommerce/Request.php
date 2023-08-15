<?php

namespace App\Services\BigCommerce;

use Illuminate\Support\Facades\Log;
use Oseintow\Bigcommerce\Bigcommerce;
use Exception;
use Illuminate\Support\Facades\Config;

class Request
{
    private $response;

    /**
     * Request constructor.
     * @param Bigcommerce $bigcommerce
     */
    public function __construct(Bigcommerce $bigcommerce)
    {
        $storeHash = Config::get('bigcommerce.store.store_hash');
        $accessToken = Config::get('bigcommerce.store.store_token');
        $this->response = $bigcommerce->setStoreHash($storeHash)->setAccessToken($accessToken);
    }


    /**
     * @param $method
     * @param $params
     * @param string $apiVersion
     * @return string
     */
    public function get($method, $params, $apiVersion = 'v3')
    {
        $this->response->setApiVersion($apiVersion);

        try {
            $params = $this->createParams($params);
            Log::info("Requested Endpoint: " . $method . $params);
            $response = $this->response->get($method . $params);
            return $response;
        } catch (Exception $e) {
            Log::critical("Endpoint: " . $method . $params . " | Exception " . $e->getMessage());
        }
    }

    /**
     * @param $method
     * @param $params
     * @param string $apiVersion
     * @return mixed
     */
    public function post($method, $params, $apiVersion = 'v3')
    {
        $this->response->setApiVersion($apiVersion);

        try {
            $params = $this->createParams($params);
            Log::info("Requested Endpoint: " . $method . $params);
            $response = $this->response->post($method, $params);
            return $response;
        } catch (Exception $e) {
            Log::critical("Endpoint: " . $method . json_encode($params) . " | Exception " . $e->getMessage());
        }
    }

    public function put($method, $params, $apiVersion = 'v3')
    {
        $this->response->setApiVersion($apiVersion);

        try {
            $params = $this->createParams($params);
            Log::info("Requested Endpoint: " . $method . json_encode($params));
            $response = $this->response->put($method, $params);
            return $response;
        } catch (Exception $e) {
            Log::critical("Endpoint: " . $method . json_encode($params) . " | Exception " . $e->getMessage());
        }
    }

    /**
     * @param $method
     * @param $params
     * @param string $apiVersion
     * @return string
     */
    public function delete($method, $params, $apiVersion = 'v3')
    {
        $this->response->setApiVersion($apiVersion);

        try {
            $params = $this->createParams($params);
            Log::info("Requested Endpoint: " . $method . $params);
            $response = $this->response->delete($method, $params);
            return $response;
        } catch (Exception $e) {
            Log::critical("Endpoint: " . $method . json_encode($params) . " | Exception " . $e->getMessage());
        }
    }

    private function createParams(array $params)
    {
        if (empty($params)) {
            return '';
        }

        $queryString = http_build_query($params);
        return '?' . $queryString;
    }
}
