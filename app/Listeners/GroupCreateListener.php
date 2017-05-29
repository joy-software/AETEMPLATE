<?php

namespace App\Listeners;

use App\Events\GroupCreateEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Role;

class GroupCreateListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  GroupCreateEvent  $event
     * @return void
     */
    public function handle(GroupCreateEvent $event)
    {
        $admin = new Role();
        $admin->name         = 'admin_'.$event->group['id'];
        $admin->display_name = 'User Administrator of '.$event->group['name'].' group'; // optional
        $admin->description  = 'User is allowed to manage and edit other users'; // optional
        $admin->group_ID  = $event->group['id']; // optional
        $admin->save();

        $permission =  \App\Permission::find(1);
        $admin->attachPermission($permission);

        //on attache le rôle admin au créateur du groupe
        $user = \App\User::find($event->group['user_ID']);
        $user->attachRole($admin);

        if(!array_has(session('group'),count(session('group'))))
        {
            session()->push('group',$event->group['id']);
        }
    }
}
