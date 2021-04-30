<?php

namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class StartCommand extends Command
{
    protected $name = "start";

    protected $description = "Start working with bot";

    public $emoji = "🚀";

    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $this->replyWithMessage([
            'text' => 'Hello! Thank you for using this bot. '
            .PHP_EOL.
            'Type /getcurrentweather for receiving info.'
            .PHP_EOL.
            'Type /show_menu for showing menu',
        ]);

        $this->triggerCommand('showmenu');
    }
}
