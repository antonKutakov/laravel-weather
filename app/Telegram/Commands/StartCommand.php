<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Services\RapidApi\OpenWeatherMapApi;
use Telegram\Bot\FileUpload\InputFile;

class StartCommand extends Command
{
    protected $name = "start";

    protected $description = "Start working with bot";

    public function handle()
    {
        $this->replyWithMessage(['text' => 'Hello! Thank you for using this bot. Type /getcurrentweather for receiving info.']);
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $this->triggerCommand('help');
    }
}
