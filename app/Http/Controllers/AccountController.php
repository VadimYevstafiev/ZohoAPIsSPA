<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Services\Contracts\APIserviceContract;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function __construct(public APIserviceContract $service) {}

    public function create()
    {
        return Inertia::render('Account/Create');
    }

    public function store(CreateAccountRequest $request)
    {
        $requestData = collect($request->validated());
        $data = [
            'data' => [
                [
                    'Owner' => [
                       'id' => config('zohoapis.user_id')
                    ],
                    'Website' => $requestData->get('website'),
                    'Phone' => $requestData->get('phone'),
                    'Account_Name' => $requestData->get('name')
                ]
            ]
        ];

        $this->service->refresh();

        $response = $this->service->insertRecopds(
            config('zohoapis.api-domain'),
            Cache::get('access_token'),
            'Accounts',
            $data
        );

        $result = json_decode($response->getBody()->getContents(), true);

        $output['account'] = true;
        if (isset($result['data'])) {
            $output['code'] = $result['data'][0]['code'];
            if ($result['data'][0]['code'] === 'SUCCESS') {
                $output['ok'] = true;
                $output['id'] = $result['data'][0]['details']['id'];
            }
        } else {
            $output['code'] = $result['code'];
        }

        return Inertia::render('Result', compact('output'));
    }
}
