<?php

namespace App\Listeners\Logout;

use App\Events\User\LoggedOut;
use App\Models\User;
use DB;

class LogoutUser
{
    public $user;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(LoggedOut $event)
    {
        $session = DB::table('sessions')->where( 'user_id', $event->getUserId() )->orderByDesc('last_activity')->first();
        if(!$session->last_activity){
          return ;
        }

       $this->user->where('id', $event->getUserId() )->update([
            'last_activity' => $this->getLastActivity($event->getUserId() )
       ]);
    }

    public function getLastActivity($userId )
    {
        return $session->last_activity;
    }
}
