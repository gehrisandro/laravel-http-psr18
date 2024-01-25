<?php

namespace HttpPsr18;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HttpPsr18 implements ClientInterface
{
    public static function make(?PendingRequest $httpClient = null): static
    {
        $httpClient ??= Http::withOptions([]);

        return new static($httpClient);
    }

    final private function __construct(protected PendingRequest $httpClient)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->httpClient
            ->withHeaders($request->getHeaders())
            ->send($request->getMethod(), (string) $request->getUri(), [
                'body' => $request->getBody()->getContents(),
            ])->toPsrResponse();
    }
}
