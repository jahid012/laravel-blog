<?php

namespace App\Listeners\Login;

use Carbon\Carbon;
use App\Events\User\LoggedIn;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserLoggedIn
{
    /**
     * Handle the event.
     *
     * @param LoggedIn $event
     * @return void
     */
    public function handle(LoggedIn $event)
    {

    }
}
