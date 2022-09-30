<?php

namespace App\Events\User;

use App\Models\User;

class Created
{
    /**
     * @var User
     */
    protected $createdUser;

    public function __construct(User $createdUser)
    {
        $this->createdUser = $createdUser;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->createdUser;
    }
}
