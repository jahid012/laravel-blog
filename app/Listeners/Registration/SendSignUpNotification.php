<?php

namespace App\Listeners\Registration;

use Illuminate\Auth\Events\Registered;
use Mail;
use App\Models\User;

class SendSignUpNotification
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $users)
    {
        $this->user = $users->where('email', request('email'))->first();
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        if (!option('notifications_signup_email')) {
            return;
        }

        try {
            Mail::to($this->user)->send(new \App\Mail\UserRegistered($event->user));
        } catch (\Throwable $th) {}
    }
}
