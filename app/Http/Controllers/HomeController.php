<?php

namespace App\Http\Controllers;

use App\Services\Contracts\APIserviceContract;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __construct(public APIserviceContract $service) {}

    public function startAuthorization()
    {
        $redirectUrl = $this->service->needStartAuthorization();
        if ($redirectUrl) {
            return redirect($redirectUrl);
        }

        return redirect()->route('account.create');
    }

    public function authorization(Request $request)
    {
        $this->service->authorization($request["accounts-server"], $request["code"]);

        return redirect()->route('account.create');
    }

}
