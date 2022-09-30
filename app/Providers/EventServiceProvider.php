<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\User\Banned;
use App\Events\User\LoggedIn;
use App\Events\User\Unconfirmed;
use App\Listeners\Users\ActivateUser;
use App\Listeners\Users\InvalidateSessionsAndTokens;
use App\Listeners\Login\UserLoggedIn;
use App\Listeners\Registration\SendSignUpNotification;
use App\Listeners\Users\UnconfirmedUser;
use App\Models\ThemeOption;
use App\Observers\ThemeOptionObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SendSignUpNotification::class,
        ],
        LoggedIn::class => [
            UserLoggedIn::class
        ],
        Banned::class => [
            InvalidateSessionsAndTokens::class
        ],
        Verified::class => [
            ActivateUser::class
        ],
        Unconfirmed::class => [
            UnconfirmedUser::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        ThemeOption::observe(ThemeOptionObserver::class);
    }

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        \App\Listeners\Activity\UserEventsSubscriber::class,
    ];
}
