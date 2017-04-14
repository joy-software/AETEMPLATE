<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ActivationKeyCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $activationKey;

    /**
     * Create a new notification instance.
     *
     * SendActivationEmail constructor.
     * @param $activationKey
     */
    public function __construct($activationKey)
    {
        $this->activationKey = $activationKey;
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
        $route = route('activation', array('activation_key' => $this->activationKey->activation_key, 'email' => $notifiable->email));
        return (new MailMessage)
            ->subject('Your Account Activation Key')
            ->greeting('Hello, '.$notifiable->username)
            ->line('Vous devez activer votre compte pour continuer à utiliser nos services.')
            ->line('Cliquer sur le boutton ci-dessous pour l\'activer')
            ->action('Activer votre compte', $route)
            ->line('Merci pour votre collaboration '. config('app.name'));
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