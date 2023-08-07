<?php

namespace App\Services\BigCommerce\Auth;

use App\Helpers\Constants;
use App\Traits\BigAuth;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RetrieveAccesstokenService
{
    use BigAuth;

    /**
     * This function retrieves the access token by making a HTTP POST request
     * with the provided installation code and returns the data received in response.
     * @param $request Installation request which contains installation code
     * @return array|null Returns the data received from API response if response is successful, otherwise null.
     */
    public function getToken($request): ?array
    {
        $baseURL = config('app.url');

        // Make the HTTP POST request to get the access token
        $response = Http::post(Constants::BC_GET_TOKEN_ENDPOINT, [
            'client_id' => $this->getAppClientId(),
            'client_secret' => $this->getAppSecret(),
            'redirect_uri' => $baseURL . '/auth/install',
            'grant_type' => Constants::BC_AUTHORIZE_CODE,
            'code' => $request->code,
            'scope' => $request->scope,
            'context' => $request->context,
        ]);

        try {
            // If response status is not OK, log error
            $response->throw();
        } catch (ClientException $exception) {
            Log::error('Get access token while installation | Exception', [$exception]);
            return null;
        }

        // Convert JSON response to Array and return it
        $data = json_decode($response->body(), true);
        return $data ?: null;
    }
}
