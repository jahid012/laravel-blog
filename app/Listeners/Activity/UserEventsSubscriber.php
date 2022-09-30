<?php

namespace App\Listeners\Activity;

use App\Events\User\Banned;
use App\Events\User\Created;
use App\Events\User\Deleted;
use App\Events\User\LoggedIn;
use App\Events\User\LoggedOut;
use App\Events\User\RequestedPasswordResetEmail;
use App\Events\User\Unconfirmed;
use App\Events\User\UpdatedProfileDetails;
use App\Models\Activity;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class UserEventsSubscriber
{
     /**
     * @var Request
     */
    private $request;
    /**
     * @var Factory
     */
    private $auth;

    /**
     * @var User|null
     */
    protected $user = null;
    /**
     * @var ActivityRepository
     */
    private $activities;

    /**
     * @var Agent
     */
    private $agent;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request, Factory $auth, Activity $activities)
    {
        $this->request = $request;
        $this->auth = $auth;
        $this->activities = $activities;

    }


    public function onLogin(LoggedIn $event)
    {
        $this->log(trans('Logged in'));
    }

    public function onLogout(LoggedOut $event)
    {
        $this->log(trans('logged out'));
    }

    public function onRegister(Registered $event)
    {
        $this->setUser($event->user);
        $this->log(trans('created account'));
    }


    public function onProfileDetailsUpdate(UpdatedProfileDetails $event)
    {
        $this->log(trans('updated profile'));
    }

    public function onDelete(Deleted $event)
    {
        $message = trans(
            'deleted user',
            ['name' => $event->getDeletedUser()->email]
        );

        $this->log($message);
    }

    public function onBan(Banned $event)
    {
        $message = trans(
            'banned user',
            ['name' => $event->getBannedUser()->email]
        );

        $this->log($message);
    }


    public function onUnConfirmed(Unconfirmed $event)
    {
        $message = trans(
            'UnConfirmed user',
            ['name' => $event->getUser()->email]
        );

        $this->log($message);
    }

    public function onCreate(Created $event)
    {
        $message = trans(
            'created account for',
            ['name' => $event->getCreatedUser()->email]
        );

        $this->log($message);
    }

    // public function onSettingsUpdate(SettingsUpdated $event)
    // {
    //     $this->log(trans('updated_settings'));
    // }

    public function onPasswordResetEmailRequest(RequestedPasswordResetEmail $event)
    {
        $this->setUser($event->getUser());
        $this->log(trans('requested password reset'));
    }

    public function onPasswordReset(PasswordReset $event)
    {
        $this->setUser($event->user);
        $this->log(trans('reseted password'));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(LoggedIn::class, [self::class, "onLogin"]);
        $events->listen(LoggedOut::class, [self::class, "onLogout"]);
        $events->listen(Registered::class, [self::class, "onRegister"]);
        $events->listen(Created::class, [self::class, "onCreate"]);
        $events->listen(ChangedAvatar::class,  [self::class, "onAvatarChange"]);
        $events->listen(UpdatedProfileDetails::class, [self::class, "onProfileDetailsUpdate"]);
        $events->listen(Deleted::class, [self::class, "onDelete"]);
        $events->listen(Banned::class, [self::class, "onBan"]);
        $events->listen(Unconfirmed::class, [self::class, "onUnConfirmed"]);

        $events->listen(SettingsUpdated::class, [self::class, "onSettingsUpdate"]);
        $events->listen(RequestedPasswordResetEmail::class, [self::class, "onPasswordResetEmailRequest"]);
        $events->listen(PasswordReset::class, [self::class, "onPasswordReset"]);
    }

    /**
     * Log user action.
     *
     * @param $description
     * @return static
     */
    public function log($description)
    {
        return $this->activities->log([
            'description' => $description,
            'user_id' => $this->getUserId(),
        ]);
    }

    /**
     * Get id if the user for who we want to log this action.
     * If user was manually set, then we will just return id of that user.
     * If not, we will return the id of currently logged user.
     *
     * @return int|mixed|null
     */
    private function getUserId()
    {
        if ($this->user) {
            return $this->user->id;
        }

        return $this->auth->guard()->id();
    }

    /**
     * @param User|null $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}
