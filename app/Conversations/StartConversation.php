<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Middleware\ReceivedMiddleware;
use App\Question as VisitorQuestion;

class StartConversation extends Conversation
{
    protected $question;

    protected $mail;

    public function getQuestion()
    {
      $question = Question::create('Veux-tu me poser une question ?')
        ->fallback("Désolé, je n'ai pas compris ta réponse")
        ->addButtons([
            Button::create('Oui')->value('yes'),
            Button::create('Non')->value('no'),
        ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                $selectedText = $answer->getText();
            }

            if ($selectedText === 'yes' || $selectedValue === 'Of course') {
                $this->ask("Je t'écoute", function (Answer $answer) {
                    $getQuestion = VisitorQuestion::where('body', $answer->getText())->first();
                    $getId = $getQuestion->id;
                    $response = VisitorQuestion::find($getId)->answer;

                    $this->say('La réponse à ta question : ' . $response->body);
                });

                $this->getFeedback();
            }

        });
    }

    public function getFeedback()
    {
        $feedback = Question::create("La réponse te convient ?")
        ->addButtons([
            Button::create('Oui')->value('oui'),
            Button::create('Non')->value('non'),
        ]);

        return $this->ask($feedback, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'oui') {
                    $this->say('Super !');
                } else {
                    $this->say('Je vais poser la question a une personne plus compétante');
                    $this->askEmail();
                }
            }
        });
    }

    public function askEmail()
    {
        $this->ask("Donne moi ton Email qu'on puisse t'envoyer la réponse", function (Answer $answer) {

            $this->email = $answer->getText();

            $this->say("Merci, on te recontactera à l'adresse suivante : " . $this->email);
        });
    }

    public function run()
    {
        $this->getQuestion();
    }
}