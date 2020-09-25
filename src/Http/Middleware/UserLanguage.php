<?php

namespace Izt\Users\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Application;

class UserLanguage
{

    /**
     * @var AuthManager
     */
    private $auth;
    /**
     * @var Application
     */
    private $app;

    /**
     * UserLanguage constructor.
     * @param AuthManager $auth
     * @param Application $app
     */
    public function __construct(AuthManager $auth, Application $app)
    {
        $this->auth = $auth;
        $this->app = $app;
    }

    public function handle($request, Closure $next)
    {

        $this->app->setLocale($this->auth->user()->lang ?? 'eu');

        return $next($request);
    }
}
