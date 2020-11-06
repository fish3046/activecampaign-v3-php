<?php

namespace Jetimob\ActiveCampaign\Http\Accounts;

use Jetimob\ActiveCampaign\Http\Resource;

class Association extends Resource
{
    protected const BASE_URL = '/api/3/accountContacts';

    public function create(array $association): array
    {
        return $this
            ->httpPost(static::BASE_URL, [
                'json' => [
                    'accountContact' => $association,
                ]
            ]);
    }

    public function update(int $id, array $association): array
    {
        return $this->httpPut(static::BASE_URL . "/{$id}", [
                'json' => [
                    'accountContact' => $association,
                ]
            ]);
    }

    public function get(int $id): array
    {
        return $this->httpGet(static::BASE_URL . "/{$id}");
    }

    public function delete(int $id): bool
    {
        return count($this->httpDelete(static::BASE_URL . "/{$id}")) === 0;
    }
}
