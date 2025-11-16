<?php

namespace mohammed_aldarwish\Workflows\Tests;

use mohammed_aldarwish\Workflows\Loggers\WorkflowLog;
use mohammed_aldarwish\Workflows\Tasks\Task;
use mohammed_aldarwish\Workflows\Triggers\ObserverTrigger;
use mohammed_aldarwish\Workflows\Workflow;
use mohammed_aldarwish\Workflows\Workflows;

class WorkflowTest extends TestCase
{
    private function createBaseSetupForWorkflows()
    {
        $workflow = Workflow::create(['name' => 'TestWorkflow']);
        $trigger = ObserverTrigger::create([
            'type' => 'mohammed_aldarwish\Workflows\Triggers\ObserverTrigger',
            'name' => 'ObserverTrigger',
            'queueable' => 1,
            'data_fields' => '{}',
            'workflow_id' => $workflow->id,
            'pos_x' => 10,
            'pos_y' => 10,
        ]);
        $task = Task::create([
            'workflow_id' => $workflow->id,
            'type' => 'mohammed_aldarwish\Workflows\Tasks\HttpStatus',
            'name' => 'HttpStatus',
            'data_fields' => '{
	"url": {
		"type": "mohammed_aldarwish\\Workflows\\DataBuses\\ValueResource",
		"value": "https://42coders.com"
	},
	"description": {
		"value": "Check if 42coders website is online"
	},
	"http_status": {
		"value": "42_coders_status"
	}
}',
            'node_id' => 1,
            'pos_x' => 100,
            'pos_y' => 10,

        ]);

        $task->parentable_id = $trigger->id;
        $task->parentable_type = get_class($trigger);

        $task->save();

        $logCreated = WorkflowLog::createHelper(
            $workflow,
            $workflow,
            $trigger
        );

        return $workflow;
    }

    /** @test */
    public function workflowCanHaveTasks()
    {
        $workflow = $this->createBaseSetupForWorkflows();

        $this->assertTrue(! empty($workflow->tasks));
    }

    /** @test */
    public function workflowCanHaveTriggers()
    {
        $workflow = $this->createBaseSetupForWorkflows();

        $this->assertTrue(! empty($workflow->triggers));
    }

    /** @test */
    public function workflowCanHaveLogs()
    {
        $workflow = $this->createBaseSetupForWorkflows();

        $this->assertTrue(! empty($workflow->logs));
    }

    /*public function getRoutes()
    {
        //Workflows::routes();

        $this->get('/workflows/index')
            ->assertStatus(200);
    }*/

    /** @test */
    public function workflowCanBeStarted()
    {
        $workflow = $this->createBaseSetupForWorkflows();

        $logCountBefore = $workflow->logs()->count();

        $workflow->triggers->first()->start($workflow, []);

        $logCountAfter = $workflow->logs()->count();

        $this->assertTrue($logCountAfter > $logCountBefore);
    }
}
