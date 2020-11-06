<?php

namespace Jetimob\ActiveCampaign\Http\Accounts;

use Jetimob\ActiveCampaign\Http\Resource;

class Accounts extends Resource
{
    protected const BASE_URL = '/api/3/accounts';

    public function create(array $account)
    {
        return $this
            ->httpPost(static::BASE_URL, [
                'json' => [
                    'account' => $account,
                ]
            ]);
    }

    public function update(int $id, array $account): array
    {
        return $this->httpPut(static::BASE_URL . "/{$id}", [
                'json' => [
                    'account' => $account,
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
