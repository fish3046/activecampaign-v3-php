<?php

namespace Jetimob\ActiveCampaign\Accounts;

use Jetimob\ActiveCampaign\Resource;

class Association extends Resource
{
    protected const BASE_URL = '/api/3/accountContacts';

    public function create(array $association)
    {
        return $this->client
            ->getClient()
            ->post(static::BASE_URL, [
                'json' => [
                    'accountContact' => $association,
                ]
            ])->getBody()->getContents();
    }

    public function update(int $id, array $association)
    {
        return $this->client
            ->getClient()
            ->put(static::BASE_URL . "/{$id}", [
                'json' => [
                    'accountContact' => $association,
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

    public function listAll(array $query_params = [])
    {
        return $this->client
            ->getClient()
            ->get(static::BASE_URL, [
                'fields' => $query_params
            ])->getBody()->getContents();
    }
}
