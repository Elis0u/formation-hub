<?php

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

test('contacts are fetched once and then served from cache', function () {
    Cache::forget('contacts');

    $user = User::factory()->create();

    Http::fake([
        'jsonplaceholder.typicode.com/*' => Http::response([
            ['id' => 1, 'name' => 'Leanne Graham', 'email' => 'leanne@example.com', 'phone' => '123-456-7890'],
        ], 200),
    ]);

    $this->actingAs($user)->get('/contacts');
    $this->actingAs($user)->get('/contacts');
    $jsonplaceholderRequests = Http::recorded(fn ($request) => $request->url() === 'https://jsonplaceholder.typicode.com/users');

    expect($jsonplaceholderRequests)->toHaveCount(1);
});