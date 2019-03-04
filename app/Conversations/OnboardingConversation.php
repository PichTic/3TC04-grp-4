<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class OnboardingConversation extends Conversation
{
    protected $question;

    protected $mail;

    public function getQuestion()
    {
        $this->ask("Hey, salut ! Je t'écoute, tu peux poser ta question", function (Answer $answer) {

            $this->question = $answer->getText();

            $this->getAnswer();
        });
    }

    public function getAnswer()
    {
        $this->say('Je vais trouver la réponse pour : ' . $this->question);
        // ici je sais pas comment récupérer un tableau associatif, questions -> réponse
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