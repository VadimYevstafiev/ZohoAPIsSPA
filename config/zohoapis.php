<?php

return [
    'version' => 'v2',

    'accounts-url' => 'https://accounts.zoho.com',

    'api-domain' => 'https://www.zohoapis.com',

    'user_id' => env('ZOHO_CRM_USER_ID'),

    'client_id' => env('ZOHO_CRM_CLIENT_ID'),

    'client_secret' => env('ZOHO_CRM_CLIENT_SECRET'),

    'homepage_url' => env('ZOHO_CRM_HOMEPAGE_URL'),

    'authorized_redirect_uri' => env('ZOHO_CRM_AUTHORIZED_REDIRECT_URIS'),
];
