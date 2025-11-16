<?php

namespace mohammed_aldarwish\Workflows\Tests;

use mohammed_aldarwish\Workflows\Workflows;
use mohammed_aldarwish\Workflows\WorkflowsServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $workflowConfig = include __DIR__.'/../config/config.php';

        Workflows::routes();

        $this->artisan('migrate', ['--database' => 'testing'])->run();
    }

    protected function getPackageProviders($app)
    {
        return [
            WorkflowsServiceProvider::class,
        ];
    }

    public function skipOnTravis()
    {
        if (! empty(getenv('TRAVIS_BUILD_ID'))) {
            $this->markTestSkipped('Skipping because this test does not run properly on Travis');
        }
    }
}
