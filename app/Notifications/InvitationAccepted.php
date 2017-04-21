<?php

namespace App\Notifications;

use App\User;
use App\group;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvitationAccepted extends Notification implements ShouldQueue
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
        return ['mail',OneSignalChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('group/view_group/'.$this->group['id']);
        if ($this->group['id'] === 1)
        {

            return (new MailMessage)
                ->subject('Accès autorisé à'.config('app.name').'.')
                ->line( $this->sender['surname'] .' '  .$this->sender['name'].', bienvenue dans la grande famille d\' anciens vogtois'.config('app.name').'.')
                ->line( 'Votre appartenance à notre grande famille a été confirmé par '.$this->validator['surname'] .' '  .$this->validator['name'].'.')
                ->line('Vous pouvez déjà vous connecter et profiter des nombreuses fonctionnalités du site.')
                ->line('Pour avoir un aperçu de ce que vous avez manqué, cliquez sur le lien ci-dessous.')
                ->action('J\'accède au site', $url)
                ->line('Merci pour votre patiente et votre envouement.');
        }
        else
        {

            return (new MailMessage)
                ->subject($this->group['name'].': Invitation acceptée')
                ->line( $this->incomingMember['surname'] .' '  .$this->incomingMember['name'].', vous pouvez déjà avoir au groupe: '. $this->group['name'])
                ->line( 'Votre adhésion a été validé par : '.$this->validator['surname'] .' '  .$this->validator['name'].'.')
                ->line('Pour avoir un aperçu de ce que vous avez manqué, cliquez sur le lien ci-dessus.')
                ->action('J\'accède au groupe', $url)
                ->line('Merci pour votre patiente et votre envouement.');
        }
    }
}
