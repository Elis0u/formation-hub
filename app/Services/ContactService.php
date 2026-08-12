<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactService
{
    public function getContacts(): Collection
    {
        try {
            $response = Http::timeout(5)->get('https://jsonplaceholder.typicode.com/users');

            if ($response->failed()) {
                Log::error('Failed to fetch contacts from external API', [
                    'status' => $response->status(),
                ]);

                return collect();
            }

            return $response->collect();
        } catch (\Exception $e) {
            Log::error('Exception while fetching contacts from external API', [
                'message' => $e->getMessage(),
            ]);

            return collect();
        }
    }
}