<?php

namespace App\Events\User;

class Unconfirmed
{
    /**
     * @var User
     */
    protected $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     *
     */
    public function getUser()
    {
        return $this->user;
    }

}
