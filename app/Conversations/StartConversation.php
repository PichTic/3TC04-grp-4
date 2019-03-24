<?php


namespace App\Conversations;
use App\Visitor;
use App\Question as VisitorQuestion;
use Illuminate\Foundation\Inspiring;
use App\Middleware\ReceivedMiddleware;
use TomLingham\Searchy\Facades\Searchy;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
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
            //prévoir le cas ou l'utilisateur se trompe et pose directement un question: OK
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                $selectedText = $answer->getText();

            }
            else{ $selectedText = 'yes';} // on force le OUI si il pose la question;

            if ($selectedText === 'yes' || $selectedValue === 'Of course') {
                $this->ask("Je t'écoute", function (Answer $answer) {

                    $getQuestion = Searchy::questions('body')->query($answer->getText())->get()->toArray();
                    $this->bot->userStorage()->save([
                        'question' => $answer->getText(),
                        ]);

                    if(isset($getQuestion)) {
                        $this->askAdmin();
                    } else {
                        $getId = $getQuestion[0]->id;
                        $response = VisitorQuestion::find($getId)->answer;

                        $this->say('La réponse à ta question : ' . $response->body);
                        $this->getFeedback();
                    }

                });
            }

        });
    }

    public function askAdmin()
    {
         $feedback = Question::create("Je n'ai pas trouver de réponse à ta question, veux-tu la poser à un administrateur ?")
        ->addButtons([
            Button::create('Oui')->value('oui'),
            Button::create('Non')->value('non'),
        ]);

        return $this->ask($feedback, function (Answer $answer) {

            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'oui') {
                    $this->askEmail();
                } else {
                    $this->say('Je reste à ta disposition !');
                }
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
                    $this->say('Je vais poser la question à une personne plus compétante');
                    $this->askEmail();
                }
            }

        });
    }

    public function askEmail()
    //ici enregistrer le couple email / question pour créer un Visitor et faire apparaitre sa question dans le dashboard Procédure : voir DatabaseSeeder.php
    {
        $this->ask("Donne moi ton Email qu'on puisse t'envoyer la réponse", function (Answer $answer) {
            $this->email = $answer->getText();

            $this->say("Merci, on te recontactera à l'adresse suivante : " . $this->email);
            $visitor = new Visitor(['email' => $this->email]);

            $question_ml = new App\Question;
            $questionAsked = $this->bot->userStorage()->find();
            $question_ml->body = $questionAsked->get('question');
            $question_ml->save();

            $question_ml->visitor()->save($visitor);
        });
    }

    public function run()
    {
        $this->getQuestion();
    }
}