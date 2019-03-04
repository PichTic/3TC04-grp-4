<?php
use App\Http\Controllers\BotManController;
use App\Conversations\OnboardingConversation;

$botman = resolve('botman');

$botman->hears('.*question.*', function ($bot) {
    $bot->startConversation(new OnboardingConversation);
});

$botman->hears('Start conversation', BotManController::class . '@startConversation');


$botman->fallback(function ($bot) {
    $bot->reply("Désolé je n'ai pas la réponse à ta question, veux-tu envoyer ta question à un humain ? ");
});
