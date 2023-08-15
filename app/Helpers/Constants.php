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
    const QUERY_INPUT_REQUEST = 'query';
    const GOOGLE_AI_API = 'https://9bde-101-53-226-51.ngrok-free.app/api/bigquery';
//     const GOOGLE_PROJECT_ID = 'merchant-assistant-395407';
//     const GOOGLE_KEY_TO_REPLACE = '{{project_id}}';
//     const GOOGLE_AUTH_TOKEN = 'ya29.a0AfB_byCq-yWfoQ9mpmROeyy9XP5Vdn-eMIwgHuvduLe5vzD5JIqPsfPq1im4sWvXlz9CeufbzLiNoNVgRNTsoMF6pBf1xlgULOLWG6mO8wcfj1xf9DS8idMKgWHSG0_KQi0WO-NorUaLKBzNNhyMp-H40pC_SJd3J8eUJQaCgYKAUISARESFQHsvYlsq0XvQWOnFkm_vm3BXrv5GA0173';
}
