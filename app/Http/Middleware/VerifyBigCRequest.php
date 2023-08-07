<?php

namespace App\Http\Middleware;

use App\Traits\BigAuth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerifyBigCRequest
{
    use BigAuth;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('signed_payload')) {
            $signedRequest = $request->input('signed_payload');
            list($encodedData, $encodedSignature) = explode('.', $signedRequest, 2) ?? ['', ''];
            // decode the data
            $signature = base64_decode($encodedSignature);
            $jsonStr = base64_decode($encodedData);
            $data = json_decode($jsonStr, true);
            // confirm the signature
            $expectedSignature = hash_hmac('sha256', $jsonStr, $this->getAppSecret());
            if (!hash_equals($expectedSignature, $signature)) {
                Log::error('Bad signed request from BigCommerce!');
                return redirect('error')->with('error_message', 'The signed request from BigCommerce could not be validated.');
            }
            $request->merge(['verified_data' => $data]);
            return $next($request);
        }
        return redirect('error')->with('error_message', 'The signed request from BigCommerce was empty.');
    }
}
