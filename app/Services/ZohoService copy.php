<?php

namespace App\Services;

use App\Services\Contracts\APIserviceContract;
use GuzzleHttp\Client;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ZohoService implements APIserviceContract
{
    public function needStartAuthorization(): bool|string
    {
        if (Cache::has('refresh_token')) {
            return false;
        }

        $response = $this->getGrantToken(
            config('zohoapis.accounts-url'),
            'ZohoCRM.modules.ALL'
        );
        return $response->handlerStats()['url'];
    }

    public function authorization(string $url, string $code): void
    {
        $response = $this->getAccessToken($url, $code);
        $result = collect(json_decode($response->getBody()->getContents(), true));

        Cache::put('access_token', $result->get('access_token'), now()->addSeconds($result->get('expires_in')));
        Cache::put('refresh_token', $result->get('refresh_token'));
    }

    protected function refresh()
    {
        if (Cache::has('access_token')) {
            return;
        }

        $response = $this->refreshToken(config('zohoapis.accounts-url'), Cache::get('refresh_token'));
        $result = collect(json_decode($response->getBody()->getContents(), true));

        Cache::put('access_token', $result->get('access_token'), now()->addSeconds($result->get('expires_in')));
    }

    public function getGrantToken(string $url, string $scope): Response
    {
        return Http::withUrlParameters([
            'url' => $url,
            'version' => config('zohoapis.version'),
            'scope' => $scope,
            'client_id' => config('zohoapis.client_id'),
            'redirect_uri' => config('zohoapis.authorized_redirect_uri')
        ])->get('{+url}/oauth/{version}/auth?scope={scope}&client_id={client_id}&response_type=code&access_type=offline&redirect_uri={redirect_uri}');
    }

    public function getAccessToken(string $url, string $code): Response
    {
        return Http::asForm()->withUrlParameters([
            'url' => $url,
            'version' => config('zohoapis.version'),
        ])
        ->post('{+url}/oauth/v2/token', [
        'grant_type' => 'authorization_code',
        'client_id' => config('zohoapis.client_id'),
        'client_secret' => config('zohoapis.client_secret'),
        'redirect_uri' => config('zohoapis.authorized_redirect_uri'),
        'code' => $code
        ]);
    }

    public function refreshToken(string $url, string $refreshToken): Response
    {
        return Http::withUrlParameters([
            'url' => $url,
            'version' => config('zohoapis.version'),
            'refresh_token' => $refreshToken,
            'client_id' => config('zohoapis.client_id'),
            'client_secret' => config('zohoapis.client_secret'),
        ])->post('{+url}/oauth/{version}/token?refresh_token={refresh_token}&client_id={client_id}&client_secret={client_secret}&grant_type=refresh_token');
    }

    public function getRecords(string $url, string $authToken, string $moduleApiName): Response
    {
        return Http::withHeaders([
            'Authorization' => "Zoho-oauthtoken $authToken"
        ])
        ->withUrlParameters([
            'url' => config('zohoapis.api-domain'),
            'version' => config('zohoapis.version'),
            'module_api_name' => $moduleApiName
        ])->get('{+url}/crm/{version}/{module_api_name}');
    }

    public function insertRecopds(string $url, string $authToken, string $moduleApiName, array $data): Response
    {
        return Http::withHeaders([
                'Authorization' => "Zoho-oauthtoken $authToken"
            ])
            ->withUrlParameters([
                'url' => config('zohoapis.api-domain'),
                'version' => config('zohoapis.version'),
                'module_api_name' => $moduleApiName
            ])->post('{+url}/crm/{version}/{module_api_name}', $data);
    }
}
