<?php

namespace App\Events\User;

use App\Models\User;

class LoggedIn {


    public function getUser()
    {
        return User::where('email', request()->email)->first();
    }
}
