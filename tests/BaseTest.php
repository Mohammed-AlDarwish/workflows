<?php

namespace mohammed_aldarwish\Workflows\Tests;

use mohammed_aldarwish\Workflows\WorkflowsServiceProvider;

class BaseTest extends TestCase
{
    public function testIfThePhpUnitRuns()
    {
        $this->assertTrue(true);
    }

    public function testIfTheServiceProviderBoots()
    {
        $serviceProvider = new WorkflowsServiceProvider(app());
        $serviceProvider->boot();

        $this->assertInstanceOf(WorkflowsServiceProvider::class, $serviceProvider);
    }
}
