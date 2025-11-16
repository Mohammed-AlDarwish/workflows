<?php

namespace mohammed_aldarwish\Workflows\Triggers;

use mohammed_aldarwish\Workflows\Loggers\WorkflowLog;

class ReRunTrigger
{
    public static function startWorkflow(WorkflowLog $log)
    {
        $log->triggerable->start($log->elementable);
    }
}
