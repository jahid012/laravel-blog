<?php

namespace App\Listeners\Users;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use App\Events\User\Banned;
use App\Events\User\LoggedIn;
use Session;
use DB;

class InvalidateSessionsAndTokens
{
    /**
     */
    private $sessions;

    public function __construct(Session $sessions)
    {
        $this->sessions = $sessions;
    }

    /**
     * Handle the event.
     *
     * @param Banned $event
     * @return void
     */
    public function handle(Banned $event)
    {
        $user = $event->getBannedUser();

        DB::table('sessions')->where('user_id', $user->id)->delete();

        $user->update( ['remember_token' => null]);
    }

}
