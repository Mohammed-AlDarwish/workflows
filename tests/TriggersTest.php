<?php

namespace mohammed_aldarwish\Workflows\Tests;

use mohammed_aldarwish\Workflows\Triggers\ObserverTrigger;
use mohammed_aldarwish\Workflows\Triggers\Trigger;

class TriggersTest extends TestCase
{
    /** @test */
    public function observerTriggerGetInputFields()
    {
        $observerTrigger = new ObserverTrigger();

        $this->assertTrue(is_array($observerTrigger->inputFields()));
    }

    /** @test */
    public function triggerTest()
    {
        $trigger = new Trigger();

        $this->assertStringContainsString(__('workflows::workflows.Settings'), $trigger->getSettings());
    }
}
