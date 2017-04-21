<?php

namespace App\Notifications;

use App\group;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\OneSignal\OneSignalMessage;
use NotificationChannels\OneSignal\OneSignalWebButton;

class IncomingMember extends Notification implements ShouldQueue
{
    use Queueable;

    public $incomingMember;
    public $group;

    /**
     * Create a new notification instance.
     * @param $newMember the member comming
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
       // return ['database','broadcast',OneSignalChannel::class];
        return ['mail','database','broadcast',OneSignalChannel::class];

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
                ->line( $this->incomingMember['surname'] .' '  .$this->incomingMember['name'].', se reclame être un ancien vogtois et voudrait
                 integrer'. config('app.name').'.')
                ->line('Pouvez-vous confirmer sur honneur qu\'il est un ancien vogtois ?')
                ->line('Pour valider son adhésion, cliquer sur le boutton ci-dessous.')
                ->action('Valider son Adhésion', $url)
                ->line('Merci pour votre collaboration!');
        }
        else
        {

            return (new MailMessage)
                ->subject($this->group['name'].': Une nouvelle demande d\'adhésion')
                ->line( $this->incomingMember['surname'] .' '  .$this->incomingMember['name'].', voudrait intégrer le groupe: '. $this->group['name'])
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
            'name_member' => $this->incomingMember['name'],
            'surname_member' => $this->incomingMember['surname'],
            'photo_member' => $this->incomingMember['photo'],
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
                ->body($this->incomingMember['name'] . ' '.$this->incomingMember['surname'] ."se reclame comme étant un ancien vogtois.")
                ->url($site)
                ->webButton(
                    OneSignalWebButton::create('link-1')
                        ->text('Cliquez ici')
                        ->icon('https://upload.wikimedia.org/wikipedia/commons/4/4f/Laravel_logo.png')
                        ->url($url)
                );
        }
        else
        {

            return OneSignalMessage::create()
                ->subject($this->group['name'].": Une nouvelle demande d'adhésion")
                ->body($this->incomingMember['name'] . ' '.$this->incomingMember['surname'] ." voudrait rejoindre le groupe: ". $this->group['name'])
                ->url($site)
                ->webButton(
                    OneSignalWebButton::create('link-1')
                        ->text('Cliquez ici')
                        ->icon('https://upload.wikimedia.org/wikipedia/commons/4/4f/Laravel_logo.png')
                        ->url($url)
                );
        }
    }

    public function routeNotificationForOneSignal()
    {
        return $this->incomingMember['id'];
    }
}
