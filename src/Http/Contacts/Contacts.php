<?php

namespace Jetimob\ActiveCampaign\Http\Contacts;

use Jetimob\ActiveCampaign\Http\Resource;
use Jetimob\ActiveCampaign\Models\Contact;

/**
 * Class Contacts
 * @package Jetimob\ActiveCampaign\Contacts
 * @see https://developers.activecampaign.com/reference#contact
 */
class Contacts extends Resource
{

    protected const BASE_URL = '/api/3/contacts';
    /**
     * Create a contact
     * @see https://developers.activecampaign.com/reference#create-contact
     */
    public function create(array $contact): array
    {
        return $this->httpPost(static::BASE_URL, [
                'json' => [
                    'contact' => $contact
                ]
            ]);
    }

    /**
     * Create or update contact
     * @see https://developers.activecampaign.com/reference#create-contact-sync
     */
    public function sync(array $contact): array
    {
        return $this->httpPost('/api/3/contact/sync', [
                'json' => [
                    'contact' => $contact
                ]
            ]);
    }

    /**
     * Get contact
     * @see https://developers.activecampaign.com/reference#get-contact
     */
    public function get(int $id): array
    {
        return $this->httpGet(static::BASE_URL . "/{$id}");
    }

    /**
     * Update a contact
     * @see https://developers.activecampaign.com/reference#update-a-contact
     */
    public function update(int $id, array $contact): array
    {
        return $this->httpPut(static::BASE_URL . "/{$id}", [
                'json' => [
                    'contact' => $contact
                ]
            ]);
    }

    /**
     * Delete a contact
     * @see https://developers.activecampaign.com/reference#delete-contact
     */
    public function delete(int $id): bool
    {
        return count($this->httpDelete(static::BASE_URL . "/{$id}")) === 0;
    }
}
