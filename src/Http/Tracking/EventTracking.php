<?php

namespace Jetimob\ActiveCampaign\Http\Tracking;

use Jetimob\ActiveCampaign\Http\Resource;

/**
 * Class EventTracking
 * @package Jetimob\ActiveCampaign\Tracking
 * @see https://developers.activecampaign.com/reference#event-tracking
 */
class EventTracking extends Resource
{

    /**
     * Retrieve status
     * @see https://developers.activecampaign.com/reference#retrieve-event-tracking-status
     */
    public function retrieveStatus(): array
    {
        return $this->httpGet('api/3/eventTracking');
    }

    /**
     * Create a new event
     * @see https://developers.activecampaign.com/v3/reference#create-a-new-event-name-only
     */
    public function createEvent(string $event_name): array
    {
        return $this->httpPost('/api/3/eventTrackingEvents', [
                'json' => [
                    'eventTrackingEvent' => [
                        'name' => $event_name
                    ]
                ]
            ]);
    }

    /**
     * Delete event
     * @see https://developers.activecampaign.com/v3/reference#remove-event-name-only
     */
    public function deleteEvent(string $event_name): bool
    {
        return count($this->httpDelete('/api/3/eventTrackingEvent/' . $event_name)) === 0;
    }

    /**
     * List all events
     * @see https://developers.activecampaign.com/v3/reference#list-all-event-types
     */
    public function listAllEvents(array $query_params = [])
    {
        return $this->httpGet('api/3/eventTrackingEvents', [
            'query' => $query_params
        ]);
    }

    /**
     * Enable/Disable event tracking
     * @see https://developers.activecampaign.com/v3/reference#enable-disable-event-tracking
     */
    public function toggleEventTracking(bool $enabled): array
    {
        return $this->httpPut('/api/3/eventTracking/', [
            'json' => [
                'eventTracking' => [
                    'enabled' => $enabled
                ]
            ]
        ]);
    }

    public function trackEvent(string $event_name, ?array $event_data = null, ?string $email = null): array
    {
        $form_params = [
            'event' => $event_name
        ];

        if (!is_null($event_data)) {
            $form_params['eventdata'] = $event_data;
        }

        if (!is_null($email)) {
            $form_params['visit'] = json_encode([
                'email' => $email
            ]);
        }

        $form_params = array_merge(
            $form_params,
            $this->client->getEventTrackingClient()->getConfig('form_params')
        );

        $req = $this->client
            ->getEventTrackingClient()
            ->post('', [
                'form_params' => $form_params
            ]);

        return $this->parse($req->getBody()->getContents());
    }

}
