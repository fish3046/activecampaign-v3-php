<?php

namespace Jetimob\ActiveCampaign\Http\Contacts;

use Jetimob\ActiveCampaign\Http\Resource;

/**
 * Class Tags
 * @package Jetimob\ActiveCampaign\Contacts
 * @see https://developers.activecampaign.com/reference#contact-tags
 */
class Tags extends Resource
{
    protected const BASE_URL = '/api/3/contactTags';

    /**
     * Create a contactTag
     * @see https://developers.activecampaign.com/reference#create-contact-tag
     */
    public function add(int $contactId, int $tagId): array
    {
        return $this->httpPost(static::BASE_URL, [
            'json' => [
                'contactTag' => [
                    'contact' => $contactId,
                    'tagId' => $tagId
                ]
            ]
        ]);
    }


    /**
     * Delete contactTag
     * @see https://developers.activecampaign.com/reference#delete-contact-tag
     */
    public function delete(int $contactTagId): bool
    {
        return count($this->httpDelete(static::BASE_URL . "/{$contactTagId}")) === 0;
    }
}
