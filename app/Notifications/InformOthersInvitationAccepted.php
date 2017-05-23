<?php

namespace App\Notifications;

use App\group;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;
use NotificationChannels\OneSignal\OneSignalWebButton;

class InformOthersInvitationAccepted extends Notification
{
    use Queueable;

    public $group;
    public $sender;

    /**
     * Create a new notification instance.
     * @param $sender  user, the person to whom the email will be send
     * @param $group group, the group in which there is an invitation
     */
    public function __construct(User $sender, group $group)
    {
        $this->group = $group;
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
        return ['database',OneSignalChannel::class];
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
            'name_member' => $this->sender['name'],
            'surname_member' => $this->sender['surname'],
            'photo_member' => $this->sender['photo'],
            'name_group' => $this->group['name'],
            'logo_group' => $this->group['logo'],
            'id_group' => $this->group['id'],
        ];
    }

    public function toOneSignal($notifiable)
    {
        $site = config(app.url);
        $url = url('group/view_group/'.$this->group['id']);
        if ($this->group['id'] === 1)
        {

            return OneSignalMessage::create()
                ->subject("Un nouvel adhérent")
                ->body($this->sender['name'] . ' '.$this->sender['surname'] ."vient d'intégrer l'association.")
                ->icon('https://member.promotvogt.org/cache/logo/'.$this->sender['photo'])
                ->url($site)
                ->webButton(
                    OneSignalWebButton::create('link-1')
                        ->text('Cliquez ici')
                        ->icon('https://member.promotvogt.org/cache/logo/PVlogo.jpeg')
                        ->url($url)
                );
        }
        else
        {

            return OneSignalMessage::create()
                ->subject($this->group['name'].": Une nouvelle demande d'adhésion")
                ->body($this->sender['name'] . ' '.$this->sender['surname'] ." \"vient d'intégrer le groupe: ". $this->group['name'])
                ->icon('https://member.promotvogt.org/cache/logo/'.$this->sender['photo'])
                ->url($site)
                ->webButton(
                    OneSignalWebButton::create('link-1')
                        ->text('Cliquez ici')
                        ->icon('https://member.promotvogt.org/cache/logo/PVlogo.jpeg')
                        ->url($url)
                );
        }
    }
}
