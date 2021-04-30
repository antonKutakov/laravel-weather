<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use Telegram;

class TelegramBotController extends Controller
{

    public function handler()
    {
        $updates = Telegram::commandsHandler(true);
        Log::debug($updates);
        return 'ok';
    }
}
