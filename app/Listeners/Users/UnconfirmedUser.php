<?php

namespace App\Listeners\Users;

use App\Events\User\Unconfirmed;

class UnconfirmedUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Unconfirmed $event)
    {
        return $event->getUser()->forceFill([
            'status' => 'unconfirmed',
            'email_verified_at' => null,
        ])->save();
    }
}
