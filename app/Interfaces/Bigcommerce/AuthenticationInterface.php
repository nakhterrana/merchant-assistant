<?php

namespace App\Interfaces\Bigcommerce;

use App\Http\Requests\InstallRequest;
use Illuminate\Http\Request;


interface AuthenticationInterface
{
    /**
     * Installs Big Auth
     *
     * 
     */
    public function install(InstallRequest $request);

    /**
     * Uninstalls Big Auth
     *
     * 
     */
    public function unInstall(Request $request);

    /**
     * Loads Big Auth
     *
     * 
     */
    public function load(Request $request);
}
