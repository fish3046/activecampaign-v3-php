<?php

namespace Jetimob\ActiveCampaign\Accounts;

use Jetimob\ActiveCampaign\Resource;

class Accounts extends Resource
{
    protected const BASE_URL = '/api/3/accounts';

    public function create(array $account)
    {
        return $this->client
            ->getClient()
            ->post(static::BASE_URL, [
                'json' => [
                    'account' => $account,
                ]
            ])->getBody()->getContents();
    }

    public function update(int $id, array $account)
    {
        return $this->client
            ->getClient()
            ->put(static::BASE_URL . "/{$id}", [
                'json' => [
                    'account' => $account,
                ]
            ])->getBody()->getContents();
    }

    public function get(int $id)
    {
        return $this->client
            ->getClient()
            ->get(static::BASE_URL . "/{$id}")->getBody()->getContents();
    }

    public function delete(int $id)
    {
        return $this->client
            ->getClient()
            ->delete(static::BASE_URL . "/{$id}")->getStatusCode() === 200;
    }

    public function listAll(array $query_params = [], int $limit = 20, int $offset = 0)
    {
        $query_params = array_merge($query_params, [
            'limit' => $limit,
            'offset' => $offset
        ]);

        return $this->client
            ->getClient()
            ->get(static::BASE_URL, [
                'query' => $query_params
            ])->getBody()->getContents();
    }
}
