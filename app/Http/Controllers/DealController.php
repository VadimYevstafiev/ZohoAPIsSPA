<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDealRequest;
use App\Services\Contracts\APIserviceContract;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class DealController extends Controller
{
    public function __construct(public APIserviceContract $service) {}

    public function create()
    {
        $accounts =  $this->getAccounts();

        return Inertia::render('Deal/Create', compact('accounts'));
    }

    public function store(CreateDealRequest $request)
    {
        $requestData = collect($request->validated());
        $data = [
            'data' => [
                [
                    'Owner' => [
                        'id' => config('zohoapis.user_id')
                    ],
                    'Account_Name' => [
                        'id' => $requestData->get('account_id')
                    ],
                    'Deal_Name' => $requestData->get('name'),
                    'Stage' => $requestData->get('stage')
                ]
            ]
        ];

        $this->service->refresh();

        $response = $this->service->insertRecopds(
            config('zohoapis.api-domain'),
            Cache::get('access_token'),
            'Deals',
            $data
        );
        $result = json_decode($response->getBody()->getContents(), true);

        $output['deal'] = true;
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

    protected function getAccounts()
    {
        $this->service->refresh();

        $response = $this->service->getRecords(
            config('zohoapis.api-domain'),
            Cache::get('access_token'),
            'Accounts'
        );
        $result = json_decode($response->getBody()->getContents(), true);
        $accounts = [];
        foreach ($result['data'] as $key => $value) {
            $accounts[$key] = [
                'id' => $value['id'],
                'name' => $value['Account_Name']
            ];
        }
        return $accounts;
    }
}
