<?php

namespace App\Middleware;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Interfaces\Middleware\Received;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use App\Question;

class ReceivedMiddleware implements Received
{
    /**
     * Handle an incoming message.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMan $bot
     *
     * @return mixed
     */
    public function received(IncomingMessage $message, $next, BotMan $bot) {
        $incomingMessage = $message->getText();
        $getQuestion = Question::where('body', $incomingMessage)->first();
        $getId = $getQuestion->id;
        $response = Question::find($getId)->answer;
        $message->addExtras('rep', $response->body);
        return $next($message);
    }
}