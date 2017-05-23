<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;
use NotificationChannels\OneSignal\OneSignalWebButton;

class Payment extends Notification
{
    use Queueable;

    public $sender;

    /**
     * Create a new notification instance.
     * @param $sender  user, the person to whom the email will be send
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
        return [OneSignalChannel::class];
    }


    public function toOneSignal($notifiable)
        {
            $site = config(app.url);
            $url = url('comptabilite');
             return OneSignalMessage::create()
                    ->subject("Paiement effectué avec succès")
                    ->body($this->sender['amount'] ."FCFA ont été reçu par paiement mobile pour votre compte".
                    "en provenance du numéro: ".$this->sender['SenderNumber'] )
                    ->url($site)
                    ->webButton(
                        OneSignalWebButton::create('link-1')
                            ->text('Cliquez ici')
                            ->icon('https://member.promotvogt.org/cache/logo/PVlogo.jpeg')
                            ->url($url)
                    );

    }
}
