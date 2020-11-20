<?php

namespace Krutyosila\Authentications\Listeners;

use Krutyosila\Authentications\Models\UserAuthentication;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use UAParser\Parser;

class LoginAuthenticationEvent
{
    /**
     * The request.
     *
     * @var \Illuminate\Http\Request
     */
    public $request;

    /**
     * Create the event listener.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $ip = $this->request->ip();
        $userAgent = $this->request->userAgent();
        $ipInfo = $this->ipInfo($ip);
        $parser = Parser::create();
        $uaParsed = $parser->parse($userAgent);

        $log = new UserAuthentication([
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'country' => isset($ipInfo['country']) ? $ipInfo['country'] : 'Local',
            'country_code' => isset($ipInfo['countryCode']) ? $ipInfo['countryCode'] : Str::upper(config('app.locale')),
            'ua_parsed' => (array) $uaParsed,
        ]);

        $user->authentications()->save($log);
    }

    public function ipInfo($ipAddr = '')
    {
        $client = Http::get('http://ip-api.com/json/' . $ipAddr);
        return $client->json();
    }
}
