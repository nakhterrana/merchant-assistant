<?php

namespace App\Helpers;

use Config, Constants, stdClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Message;


class Helper{

    protected $client;



    public static function google_ai_api_request($query){

        $url = Constants::GOOGLE_AI_API;
        $url = str_replace(Constants::GOOGLE_KEY_TO_REPLACE, Constants::GOOGLE_PROJECT_ID, $url);
        $object = Helper::createRequestObject($query);

        
        try{
            $requestConfig = [
                'headers' => [
                    'Authorization' => 'Bearer'.' '.Constants::GOOGLE_AUTH_TOKEN,
                    'Content-Type'  => 'application/json',
                ]
            ];
    
            $requestConfig['body'] = json_encode($object);  

            $client = new Client;
            $result = $client->request('POST', $url, $requestConfig);
            $data = json_decode($result->getBody(), true);
            return $data;
        } catch (Exception $e) {
            return array(
                'message' => $e->getMessage(),
                'response' => 'error'
            );
        }
       
        return $result;
    }

    public static function createRequestObject($query) {
        $paramerters = new stdClass;
        $paramerters->temperature = 0.2;
        $paramerters->maxOutputTokens = 256;
        $paramerters->topK = 40;
        $paramerters->topP = 0.95;

        $prompt = new stdClass;
        $prompt->prompt = $query;

        $requestObject = [
            "instances" => [
                $prompt
            ],
            "parameters" => $paramerters
        ];
    
        return $requestObject;
    }




}
