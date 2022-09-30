<?php

namespace App\Listeners\Users;

use Illuminate\Auth\Events\Verified;
use App\Repositories\User\UserRepository;

class ActivateUser
{
    /**
     * @var UserRepository
     */
    private $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * Handle the event.
     *
     * @param Verified $event
     * @return void
     */
    public function handle(Verified $event)
    {
        return $event->getUser()->forceFill([
            'status' => 'active',
            'email_verified_at' => now(),
        ])->save();
    }
}
