<?php

namespace Jetimob\ActiveCampaign\Http\Deals;

use Jetimob\ActiveCampaign\Http\Resource;

/**
 * Class Deals
 * @package Jetimob\ActiveCampaign\Deals
 * @see https://developers.activecampaign.com/reference#deal
 */
class Deals extends Resource
{

    /**
     * Create a deal
     * @see https://developers.activecampaign.com/reference#create-a-deal
     */
    public function create(array $deal): array
    {
        return $this->httpPost('/api/3/deals', [
                'json' => [
                    'deal' => $deal
                ]
            ]);
    }

    /**
     * Get a deal by id
     * @see https://developers.activecampaign.com/reference#retrieve-a-deal
     */
    public function get(int $id): array
    {
        return $this->httpGet('/api/3/deals/' . $id);
    }

    /**
     * Update a deal
     * @see https://developers.activecampaign.com/reference#update-a-deal
     */
    public function update(int $id, array $deal): array
    {
        return $this->httpPut('/api/3/deals/' . $id, [
                'json' => [
                    'deal' => $deal
                ]
            ]);
    }

    /**
     * Delete a deal by id
     * @see https://developers.activecampaign.com/reference#delete-a-deal
     */
    public function delete(int $id): bool
    {
        return $this->httpDelete('/api/3/deals/' . $id);
    }

    /**
     * Move deals to another stage
     * @see https://developers.activecampaign.com/reference#move-deals-to-another-deal-stage
     */
    public function moveToStage(int $id, array $deal): array
    {
        return $this->httpPut('/api/3/dealStages/' . $id . '/deals', [
                'json' => [
                    'deal' => $deal
                ]
            ]);
    }

    /**
     * Create a deal custom field value
     * @see https://developers.activecampaign.com/v3/reference#create-dealcustomfielddata-resource
     *
     */
    public function createCustomFieldValue(int $deal_id, int $field_id, $field_value): array
    {
        return $this->httpPost('/api/3/dealCustomFieldData', [
                'json' => [
                    'dealCustomFieldDatum' => [
                        'dealId' => $deal_id,
                        'custom_field_id' => $field_id,
                        'fieldValue' => $field_value
                    ]
                ]
            ]);
    }

    /**
     * Retrieve a custom field value
     * @see https://developers.activecampaign.com/v3/reference#retrieve-a-dealcustomfielddata
     */
    public function retrieveCustomFieldValue(int $custom_field_id): array
    {
        return $this->httpGet('/api/3/dealCustomFieldData/' . $custom_field_id);
    }

    /**
     * Update a custom field value
     * @see https://developers.activecampaign.com/v3/reference#update-a-dealcustomfielddata-resource
     */
    public function updateCustomFieldValue(int $custom_field_id, $field_value): array
    {
        return $this->httpPut('/api/3/dealCustomFieldData/' . $custom_field_id, [
                'json' => [
                    'dealCustomFieldDatum' => [
                        'fieldValue' => $field_value
                    ]
                ]
            ]);
    }

    /**
     * Delete a custom field value
     * @see https://developers.activecampaign.com/v3/reference#retrieve-a-dealcustomfielddata-resource
     */
    public function deleteCustomFieldValue(int $custom_field_id): bool
    {
        return (bool) $this->httpDelete('/api/3/dealCustomFieldData/' . $custom_field_id);
    }

    /**
     * List all custom fields
     * @see https://developers.activecampaign.com/reference#retrieve-all-dealcustomfielddata-resources
     */
    public function listAllCustomFields(array $query_params = []): array
    {
        return $this->httpGet('/api/3/dealCustomFieldMeta', [
                'query' => $query_params
            ]);
    }

    /**
     * List all custom field values
     * @see https://developers.activecampaign.com/reference#list-all-custom-field-values
     */
    public function listAllCustomFieldValues(array $query_params): array
    {
        return $this->httpGet('/api/3/dealCustomFieldData', [
            'query' => $query_params
        ]);
    }

    /**
     * List all pipelines
     * @see https://developers.activecampaign.com/reference#list-all-pipelines
     */
    public function listAllPipelines(array $query_params = []): array
    {
        return $this->httpGet('/api/3/dealGroups', [
                'query' => $query_params
            ]);
    }

    /**
     * List all stages
     * @see https://developers.activecampaign.com/reference#list-all-deal-stages
     */
    public function listAllStages(array $query_params = []): array
    {
        return $this->httpGet('/api/3/dealStages', [
                'query' => $query_params
            ]);
    }

}
