<?php

namespace Krutyosila\Authentications;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;

class AuthenticationsProvider extends ServiceProvider
{

    public function boot()
    {
        $events = [
            'Illuminate\Auth\Events\Login' => [
                'Krutyosila\Authentications\Listeners\LoginAuthenticationEvent',
            ],
        ];
        $this->registerEvents($events);
        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations'),
        ], 'authentication-migrations');
    }


    protected function registerEvents($authenticationEvents)
    {
        $events = $this->app->make(Dispatcher::class);
        foreach ($authenticationEvents as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }
    }

    public function register()
    {
    }
}
