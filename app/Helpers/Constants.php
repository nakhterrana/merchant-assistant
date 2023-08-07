<?php

namespace App\Helpers;

class Constants
{

    const BC_API_ENDPOINT = "https://api.bigcommerce.com/";
    const BC_LOGIN_ENDPOINT = "https://login.bigcommerce.com/";
    const BC_GET_TOKEN_ENDPOINT = self::BC_LOGIN_ENDPOINT . 'oauth2/token';
    const TRIAL_DAYS = 10;
    const BC_WEBDAV_BASE_URI = "https://store-%s.mybigcommerce.com/dav";
    const BC_REPLACE_KEY_URL = "{{url}}";
    const BC_STORE = "stores/";
    const BC_AUTHORIZE_CODE = "authorization_code";
    const BC_REPLACE_KEY_APP_CLIENT_ID = "{{app_client_id}}";
    const BC_REPLACE_KEY_STORE_CHANNEL_ID = "{{store_channel_id}}";
    const STREAM_CONTENT_TYPE = "application/octet-stream";
    const STREAM_DISPOSITION = "attachment";
    const READ_FILE_BYTE_ALLOWED = 1024; //1 GB OF FILE CAN BE READ
}
