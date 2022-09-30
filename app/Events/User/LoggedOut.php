<?php

namespace App\Events\User;

class LoggedOut {
    /**
     * @var $userId
     */
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }
}
