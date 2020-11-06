<?php

namespace Jetimob\ActiveCampaign\Http;

use GuzzleHttp\Exception\RequestException;
use Jetimob\ActiveCampaign\Http\Exceptions\BadRequest;
use Jetimob\ActiveCampaign\Http\Exceptions\Forbidden;
use Jetimob\ActiveCampaign\Http\Exceptions\NotFound;
use Jetimob\ActiveCampaign\Http\Exceptions\Unknown;
use Jetimob\ActiveCampaign\Http\Exceptions\Unprocessable;

class Resource
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    private function httpRequest(string $method, string $url, array $data = []): array
    {
        try {
            return $this->parse(
                $this->client->getClient()->$method($url, $data)->getBody()->getContents()
            );
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $responseData = $this->parse($response->getBody()->getContents());
            switch ($response->getStatusCode()) {
                case 404:
                    throw new NotFound($responseData['message'], $response->getStatusCode(), $e);
                case 403:
                    throw new Forbidden($responseData['message'], $response->getStatusCode(), $e);
                case 422:
                    throw new Unprocessable(json_encode($responseData), $response->getStatusCode(), $e);
                case 400:
                    throw new BadRequest('Bad request', $response->getStatusCode(), $e);
                default:
                    throw new Unknown('Unknown reason', $response->getStatusCode(), $e);
            }
        }
    }

    protected function parse(string $data): array
    {
        return json_decode($data, true);
    }

    protected function httpPost(string $url, array $data = []): array
    {
        return $this->httpRequest('post', $url, $data);
    }

    protected function httpDelete(string $url, array $data = []): array
    {
        return $this->httpRequest('delete', $url, $data);
    }

    protected function httpPut(string $url, array $data = []): array
    {
        return $this->httpRequest('put', $url, $data);
    }

    protected function httpGet(string $url, array $data = []): array
    {
        return $this->httpRequest('get', $url, $data);
    }

    protected function httpPatch(string $url, array $data = []): array
    {
        return $this->httpRequest('patch', $url, $data);
    }

}
