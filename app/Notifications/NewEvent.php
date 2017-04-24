<?php

namespace App\Notifications;

use App\group;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\OneSignal\OneSignalChannel;

class NewEvent extends Notification implements  ShouldQueue
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
        return ['database','broadcast',OneSignalChannel::class];
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
}
