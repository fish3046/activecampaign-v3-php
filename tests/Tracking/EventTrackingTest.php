<?php
/**
 * EventTrackingTest.php
 * Date: 2019-01-29
 * Time: 17:01
 */

namespace Jetimob\ActiveCampaign\Http\Tests\Tracking;

use Jetimob\ActiveCampaign\Http\Tracking\EventTracking;
use Jetimob\ActiveCampaign\Tests\ResourceTestCase;

class EventTrackingTest extends ResourceTestCase
{

    public function testTrackEvent()
    {
        $tracking = new EventTracking($this->client);
        $track = $tracking
            ->trackEvent(
                'test',
                null,
                null
            );

        $event = json_decode($track, true);
        $this->assertArrayHasKey('success', $event);
        $this->assertEquals(1, $event['success']);
    }

}
