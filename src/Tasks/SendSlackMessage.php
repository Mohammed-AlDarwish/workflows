<?php

namespace mohammed_aldarwish\Workflows\Tasks;

use Illuminate\Support\Facades\Notification;
use mohammed_aldarwish\Workflows\Notifications\SlackNotification;

class SendSlackMessage extends Task
{
    public static $fields = [
        'Channel/User' => 'channel',
        'Message' => 'message',
    ];

    public static $output = [
        'Output' => 'output',
    ];

    public static $icon = '<i class="fab fa-slack"></i>';

    public function execute(): void
    {
        $channel = $this->getData('channel');
        $message = $this->getData('message');

        Notification::route('slack', env('WORKFLOW_SLACK_CHANNEL'))
            ->notify(new SlackNotification($channel, $message));
    }
}
