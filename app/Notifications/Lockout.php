<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class Lockout extends Notification
{
    use Queueable;

    public $sender;

    /**
     * Create a new notification instance.
     * @param $sender  user, the person to whom the email will be send
     * @return void
     */
    public function __construct(User $sender)
    {
        $this->sender = $sender;
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
        $url = url('/password/reset');

            return (new MailMessage)
                ->subject('Activité Suspecte')
                ->line( $this->sender['surname'] .' '  .$this->sender['name'].', nous avons constaté un comportement anormal lié à votre compte.')
                ->line( 'Un individu a essayer de se connecter à votre compte sans succès, il y\'a quelques instants')
                ->line('S\'il ne s\'agit pas de vous, cliquer sur le lien ci-dessous pour sécuriser votre compte.')
                ->action('Je sécurise mon compte', $url)
                ->line('Merci pour votre collaboration.');


    }
}
