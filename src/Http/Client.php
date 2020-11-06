<?php

namespace Jetimob\ActiveCampaign\Http;

class Client
{

    public const HEADER_AUTH_KEY = 'Api-Token';

    public const LIB_USER_AGENT = 'activecampaign-v3-php/1.0';

    public const API_VERSION_URL = '/api/3';

    public const EVENT_TRACKING_URL = 'https://trackcmp.net/event';

    /**
     * ActiveCampaign API URL.
     * Format is https://YOUR_ACCOUNT_NAME.api-us1.com
     */
    protected string $api_url;

    /**
     * ActiveCampaign API token
     * Get yours from developer settings.
     */
    protected string $api_token;

    /**
     * Event Tracking ACTID
     * Get yours from Settings > Tracking > Event Tracking > Event Tracking API
     */
    protected ?string $event_tracking_actid;

    /**
     * Event Tracking Key
     * Get yours from Settings > Tracking > Event Tracking > Event Key
     */
    protected ?string $event_tracking_key;

    private \GuzzleHttp\Client $client;

    private \GuzzleHttp\Client $event_tracking_client;

    public function __construct(string $api_url, string $api_token, string $event_tracking_actid = null, string $event_tracking_key = null)
    {
        $this->api_url = $api_url;
        $this->api_token = $api_token;
        $this->event_tracking_actid = $event_tracking_actid;
        $this->event_tracking_key = $event_tracking_key;

        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->api_url,
            'headers' => [
                'User-Agent' => self::LIB_USER_AGENT,
                self::HEADER_AUTH_KEY => $this->api_token,
                'Accept' => 'application/json'
            ]
        ]);

        if (!is_null($this->event_tracking_actid) && !is_null($this->event_tracking_key)) {
            $this->event_tracking_client = new \GuzzleHttp\Client([
                'base_uri' => self::EVENT_TRACKING_URL,
                'headers' => [
                    'User-Agent' => self::LIB_USER_AGENT,
                    'Accept' => 'application/json'
                ],
                'form_params' => [
                    'actid' => $this->event_tracking_actid,
                    'key' => $this->event_tracking_key
                ]
            ]);
        }
    }

    public function getClient(): \GuzzleHttp\Client
    {
        return $this->client;
    }

    public function getEventTrackingClient() : ?\GuzzleHttp\Client
    {
        if (is_null($this->event_tracking_actid)) {
            return null;
        }
        return $this->event_tracking_client;
    }

    public function getApiUrl(): string
    {
        return $this->api_url;
    }

    public function getApiToken(): string
    {
        return $this->api_token;
    }

    public function getEventTrackingActid(): ?string
    {
        return $this->event_tracking_actid;
    }

}
