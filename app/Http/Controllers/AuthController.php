<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Http\Requests\InstallRequest;
use App\Interfaces\Bigcommerce\AuthenticationInterface;
use App\Traits\BigAuth;
use App\Models\User;
use App\Services\BigCommerce\Auth\RetrieveAccesstokenService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller implements AuthenticationInterface
{
    use BigAuth;

    public function __construct(
        private RetrieveAccesstokenService $retrieveAccessToken
    ) {
    }

    /** 
     * Install the app by making an OAuth2 token request 
     * updates or creates a new user record, logs in the user, 
     * and redirects them to the appropriate page.

     * @param Request $request
     */
    public function install(InstallRequest $request)
    {
        try {
            $data = $this->retrieveAccessToken->getToken($request);
        
            if (!$data) {
                return redirect()->route('error')->with('error_message', 'An error occurred during installation.');
            }

            $user = User::updateOrcreateOnInstall($data);

            return $this->loginAndRedirectUser($user, $request);
        } catch (Exception $e) {
            Log::error('App installation hook | Exception', [$e]);
            return redirect('error')->with('error_message', $e->getMessage() ?: "An error occurred.");
        }
    }

    /**
     * load the app by making an OAuth2 token request
     *
     * @param Request $request
     * @return Illuminate\Support\Facades\Redirect
     */
    public function load(Request $request)
    {
        try {
            $verifiedSignedRequestData = $request->verified_data;
            $user = User::updateOrcreateOnLoad($verifiedSignedRequestData);
            return $this->loginAndRedirectUser($user, $request);
        } catch (Exception $e) {
            Log::error("App load hook | Exception", [$e]);
        }
    }

    /**
     * Method uninstall
     *
     * @return Illuminate\Support\Facades\Redirect|string
     */
    public function uninstall(Request $request)
    {
        try {
            return redirect('/');
        } catch (Exception $e) {
            Log::error("Uninstall hook | Exception", [$e]);
        }
    }

    /**
     * Redirect the user to the appropriate page
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginAndRedirectUser($user, $request)
    {
        Auth::login($user, true);
        $redirectUrl = '/';
        if ($request->has('external_install')) {
            $redirectUrl = Constants::BC_LOGIN_ENDPOINT . 'app/' . $this->getAppClientId() . '/install/succeeded';
        }
        return redirect($redirectUrl);
    }
}
