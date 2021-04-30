<?php

namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class ShowMenuCommand extends Command
{
    protected $name = "showmenu";

    protected $description = "Showing menu";

    public $emoji = "📑";

    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $commands = $this->getTelegram()->getCommands();

        $keyboard = Keyboard::make()->setResizeKeyboard(true);
        foreach ($commands as $name => $command) {
            // Log::debug($command);
            $keyboard->row(Keyboard::inlineButton([
                'text' => "/$name ".$command->emoji,
                'callback_data' => "/$name",
            ]));
        }

        Log::debug($keyboard);

        $this->replyWithMessage([
            'text' => 'Menu was shown',
            'reply_markup' => $keyboard,
        ]);
    }
}
