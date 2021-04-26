<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Telegram;

class TelegramBotController extends Controller
{

    public function handler()
    {
        $updates = Telegram::commandsHandler(true);
        $date = date('d M, Y H:i', strtotime('+3 hours', $updates->message->date));
        Log::info("TELEGRAM UPDATE: DATE => $date");
        Log::debug($updates);
    }
}
