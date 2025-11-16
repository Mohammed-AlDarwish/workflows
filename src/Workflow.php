<?php

namespace mohammed_aldarwish\Workflows;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    private $data;

    protected $table = 'workflow_workflows';

    protected $fillable = [
        'name',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('workflows.db_prefix').$this->table;
        parent::__construct($attributes);
    }

    public function tasks()
    {
        return $this->hasMany('mohammed_aldarwish\Workflows\Tasks\Task');
    }

    public function triggers()
    {
        return $this->hasMany('mohammed_aldarwish\Workflows\Triggers\Trigger');
    }

    public function logs()
    {
        return $this->hasMany('mohammed_aldarwish\Workflows\Loggers\WorkflowLog');
    }

    public function getTriggerByClass($class)
    {
        return $this->triggers()->where('type', $class)->first();
    }
}
