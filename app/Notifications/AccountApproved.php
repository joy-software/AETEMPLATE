<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;
use NotificationChannels\OneSignal\OneSignalWebButton;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountApproved extends Notification
{
    use Queueable;

    public $sender;

    /**
     * Create a new notification instance.
     *@param $sender  user, the person to whom the email will be send
     * @return void
     */
    public function __construct(User $sender)
    {
        $this->sender = $sender;
    }

    public function via($notifiable)
    {
        return [OneSignalChannel::class];
    }

    public function toOneSignal($notifiable)
    {
        $site = config(app.url);
        $url = url('/accueil');
            return OneSignalMessage::create()
                ->subject("Acceuil | PromotVogt")
                ->body($this->sender['name'] . ' '.$this->sender['surname'] .", nous sommes ravis de vous revoir.")
                ->url($site)
                ->webButton(
                    OneSignalWebButton::create('link-1')
                        ->text('Cliquez ici')
                        ->icon('https://member.promotvogt.org/cache/logo/PVlogo.jpeg')
                        ->url($url)
                );
    }
}
