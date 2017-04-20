<?php

namespace App\Notifications;

use App\group;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InformOthersInvitationAccepted extends Notification
{
    use Queueable;

    public $group;
    public $validator;
    public $sender;

    /**
     * Create a new notification instance.
     * @param $validator  user who has accepted my invitation
     * @param $sender  user, the person to whom the email will be send
     * @param $group group, the group in which there is an invitation
     * @return void
     */
    public function __construct(User $validator,group $group,User $sender)
    {
        $this->validator = $validator;
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
        return ['database','broadcast'];
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
            'name_member' => $this->incomingMember['name'],
            'surname_member' => $this->incomingMember['surname'],
            'photo_member' => $this->incomingMember['photo'],
            'name_group' => $this->group['name'],
            'logo_group' => $this->group['logo'],
            'id_group' => $this->group['id'],
            'id_member'=> $this->incomingMember['id']
        ];
    }
}
