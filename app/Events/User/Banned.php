<?php

namespace App\Events\User;

use App\Models\User;

class Banned
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getBannedUser()
    {
        return $this->user;
    }
}
