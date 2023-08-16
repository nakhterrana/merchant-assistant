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
        try{
            $client = new Client;
            $result = $client->request('GET', $url.'?query='.$query);
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
}
