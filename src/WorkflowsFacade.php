<?php

namespace mohammed_aldarwish\Workflows;

use Illuminate\Support\Facades\Facade;

/**
 * @see mohammed_aldarwish\Workflows\Skeleton\SkeletonClass
 */
class WorkflowsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'workflows';
    }
}
