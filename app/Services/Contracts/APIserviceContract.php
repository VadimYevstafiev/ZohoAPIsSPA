<?php

namespace App\Services\Contracts;

use Illuminate\Http\Client\Response;

interface APIserviceContract
{
    public function needStartAuthorization(): bool|string;

    public function authorization(string $url, string $code): void;

    public function refresh(): void;

    public function getRecords(string $url, string $authToken, string $moduleApiName): Response;

    public function insertRecopds(string $url, string $authToken, string $moduleApiName, array $data): Response;
}
