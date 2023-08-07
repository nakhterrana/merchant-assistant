<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

trait JwtDecoder
{
    /**
     * Decodes a JWT Token.
     *
     * @param string $token The JWT Token to decode.
     *
     * @return object|null Returns the decoded payload or null if an error occurs.
     */
    public function decodeToken(string $token): ?object
    {
        try {
            $payload = json_decode(base64_decode(explode('.', $token)[1]));

            // Check if payload could not be decoded
            if (!$payload) {
                throw new InvalidArgumentException('Invalid Token');
            }

            return $payload;
        } catch (Exception $ex) {
            Log::alert("JWT Decoder Exception: {$ex->getMessage()}");

            return null;
        }
    }
}
