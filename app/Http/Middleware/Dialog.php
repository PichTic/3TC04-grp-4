<?php

use BotMan\BotMan\Middleware\ApiAi;

$dialogflow = ApiAi::create('your-api-ai-token')->listenForAction();

// Apply global "received" middleware
$botman->middleware->received($dialogflow);

// Apply matching middleware per hears command
$botman->hears('my_api_action', function (BotMan $bot) {
    // The incoming message matched the "my_api_action" on Dialogflow
    // Retrieve Dialogflow information:
    $extras = $bot->getMessage()->getExtras();
    $apiReply = $extras['apiReply'];
    $apiAction = $extras['apiAction'];
    $apiIntent = $extras['apiIntent'];

    $bot->reply("this is my reply");
})->middleware($dialogflow);