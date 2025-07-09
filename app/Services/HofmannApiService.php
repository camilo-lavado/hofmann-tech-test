<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HofmannApiService
{
    private string $baseUrl = 'https://prueba.drogueriahofmann.cl';

    public function getTableUsers(): array
    {
        $response = Http::get("{$this->baseUrl}/ListTableUsers");
        return $response->successful() ? $response->json() : [];
    }

    public function getCodes(): array
    {
        $response = Http::get("{$this->baseUrl}/GetUsers");
        return $response->successful() ? $response->json() : [];
    }

    public function sendUser(array $data): int
    {
        $response = Http::post("{$this->baseUrl}/SendUser", $data);
        return $response->status();
    }
}
