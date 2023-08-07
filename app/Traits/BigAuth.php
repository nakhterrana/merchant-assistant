<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait BigAuth
{

    /**
     * Method getAppClientId
     *
     * @return string
     */
    public function getAppClientId(): string
    {
        return app()->environment('local')
            ? config('bigcommerce.bc_local_client_id')
            : config('bigcommerce.bc_app_client_id');
    }

    /**
     * Method getAppSecret
     *
     * @return string
     */
    public function getAppSecret(): string
    {
        return app()->environment('local')
            ? config('bigcommerce.bc_local_secret')
            : config('bigcommerce.bc_app_secret');
    }

    /**
     * Method getAccessToken
     *
     * @return string
     */
    public function getAccessToken(): string
    {
        return app()->environment('local')
            ? config('bigcommerce.bc_local_access_token')
            : Auth::user()->password;
    }

    /**
     * Method getStoreHash
     *
     * @return string
     */
    public function getStoreHash(): string
    {
        return app()->environment('local')
            ? config('bigcommerce.bc_local_store_hash')
            : Auth::user()->store_hash;
    }
}
