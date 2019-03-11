<?php
use App\Http\Controllers\BotManController;
use App\Middleware\ReceivedMiddleware;
use App\Conversations\OnboardingConversation;

$botman = resolve('botman');

$botman->middleware->received(new ReceivedMiddleware());

$botman->hears('(.*)', function($bot) {
    $response = $bot->getMessage()->getExtras('rep');
    $bot->reply($response);
});

$botman->hears('.*question.*', function ($bot) {
    $bot->startConversation(new OnboardingConversation);
});

$botman->hears('salut', function ($bot) {
    $bot->reply('salut');
});

$botman->hears('Start conversation', BotManController::class . '@startConversation');


// $botman->fallback(function ($bot) {
//     $bot->reply("Désolé je n'ai pas la réponse à ta question, veux-tu envoyer ta question à un humain ? ");
// });
