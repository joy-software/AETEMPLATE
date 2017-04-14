<?php

namespace App\Notifications;

use App\group;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class IncomingMember extends Notification implements ShouldQueue
{
    use Queueable;

    public $incomingMember;
    public $group;

    /**
     * Create a new notification instance.
     * @param a new member comming
     * @param group : the group where there is a new demand of admission
     * @return void
     */
    public function __construct(User $newMember,group $group)
    {
        $this->incomingMember = $newMember;
        $this->group = $group;
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
        $url = url('group/view_group/'.$this->group['id']);
        if ($this->group['id'] === 1)
        {

            return (new MailMessage)
                ->subject('Un nouvel adhérent')
                ->line( $this->incomingMember['surname'] .' '  .$this->incomingMember['name'].', voudrait intégrer l\'association Promot-Vogt. ')
                ->line('Pouvez-vous confirmer sur honneur qu\'il est un ancien vogtois ?')
                ->line('Pour valider son adhésion, cliquer sur le boutton ci-dessous.')
                ->action('Valider son Adhésion', $url)
                ->line('Merci pour votre collaboration!');
        }
        else
        {

            return (new MailMessage)
                ->subject($this->group['name'].': Une nouvelle demande d\'adhésion')
                ->line( $this->incomingMember['surname'] .' '  .$this->incomingMember['name'].', voudrait intégrer le groupe: '. $this->group['name'].)
                ->line('Pour valider son adhésion, cliquer sur le boutton ci-dessous.')
                ->action('Valider son Adhésion', $url)
                ->line('Merci pour votre collaboration!');
        }
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
