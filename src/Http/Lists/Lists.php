<?php

namespace Jetimob\ActiveCampaign\Http\Lists;

use Jetimob\ActiveCampaign\Http\Resource;

/**
 * Class Lists
 * @package Jetimob\ActiveCampaign\Lists
 * @see https://developers.activecampaign.com/reference#lists
 */
class Lists extends Resource
{

    /**
     * Create a list
     * @see https://developers.activecampaign.com/reference#create-new-list
     */
    public function create(array $list): array
    {
        return $this->httpPost('/api/3/lists', [
            'json' => [
                'list' => $list
            ]
        ]);
    }

    /**
     * Retrieve all lists or a list when id is not null
     * @see https://developers.activecampaign.com/reference#retrieve-a-list
     */
    public function retrieve(int $id = null, array $query_params = []): array
    {
        $uri = '/api/3/lists';
        if (!is_null($id)) {
            $uri .= '/' . $id;
        }
        return $this->httpGet($uri,  [
            'query' => $query_params
        ]);
    }

    /**
     * Delete a list
     * @see https://developers.activecampaign.com/reference#delete-a-list
     */
    public function delete(int $id): bool
    {
        return count($this->httpDelete('/api/3/lists/' . $id)) === 0;
    }

}
