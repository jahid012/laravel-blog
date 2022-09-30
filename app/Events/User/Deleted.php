<?php

namespace App\Events\User;


class Deleted
{
    /**
     * @var $deletedUser
     */
    protected $deletedUser;

    public function __construct($deletedUser)
    {
        $this->deletedUser = $deletedUser;
    }

    /**
     * @return User
     */
    public function getDeletedUser()
    {
        return $this->deletedUser;
    }
}
