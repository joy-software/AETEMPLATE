<?php

namespace App\Events;

use App\group;

use Illuminate\Queue\SerializesModels;


class GroupCreateEvent
{
    use SerializesModels;

    /**
     * The group referrer.
     *
     * @var \App\group
     */
    public $group;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(group $group)
    {
        $this->group = $group;
    }


}
