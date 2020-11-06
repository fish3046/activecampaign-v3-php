<?php

namespace Jetimob\ActiveCampaign\Http\Tags;

use Jetimob\ActiveCampaign\Http\Resource;

/**
 * Class Tags
 * @package Jetimob\ActiveCampaign\Tags
 * @see https://developers.activecampaign.com/reference#tags
 */
class Tags extends Resource
{

    /**
     * List all tags
     * @see https://developers.activecampaign.com/reference#retrieve-all-tags
     */
    public function listAll(array $query_params = []): array
    {
        return $this->httpGet('/api/3/tags', [
            'query' => $query_params
        ]);
    }

}
