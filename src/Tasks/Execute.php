<?php

namespace mohammed_aldarwish\Workflows\Tasks;

class Execute extends Task
{
    public static $fields = [
        'Command' => 'command',
    ];

    public static $output = [
        'Command Output' => 'command_output',
    ];

    public static $icon = '<i class="fas fa-terminal"></i>';

    public function execute(): void
    {
        chdir(base_path());
        dd(shell_exec($this->getData('command').' 2>&1'));
        $this->setData('command_output', shell_exec($this->getData('command')));
    }
}
