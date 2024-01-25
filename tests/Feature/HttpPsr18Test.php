<?php

use GuzzleHttp\Psr7\Request;
use HttpPsr18\HttpPsr18;
use Illuminate\Support\Facades\Http;

it('can create an instance and send a request', function () {
    Http::fake([
        '*' => Http::response('Hello World', 200),
    ]);

    $pendingRequest = Http::timeout(100);

    $client = HttpPsr18::make($pendingRequest);

    $request = new Request('GET', 'https://example.com');

    expect($client->sendRequest($request))
        ->getBody()->getContents()->toBe('Hello World')
        ->getStatusCode()->toBe(200);
});

it('can create an instance with a client from the http facade', function () {
    Http::fake([
        '*' => Http::response('Hello World', 200),
    ]);

    $client = HttpPsr18::make();

    $request = new Request('GET', 'https://example.com');

    expect($client->sendRequest($request))
        ->getBody()->getContents()->toBe('Hello World')
        ->getStatusCode()->toBe(200);
});
