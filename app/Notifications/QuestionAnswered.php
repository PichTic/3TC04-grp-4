<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class QuestionAnswered extends Notification
{
    use Queueable;
    protected $answer;
    protected $question;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($answer, $question)
    {
        $this->answer = $answer;
        $this->question = $question;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Bonjour,')
                    ->line('Vous nous avez posez cette question : ' . $this->question)
                    ->line('Voici la réponse : ' . $this->answer)
                    ->line("Merci d'avoir utiliser nos services");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
