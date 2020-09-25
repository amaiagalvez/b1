<?php

namespace Izt\Users\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Auth\AuthManager;
use Izt\Users\Storage\Interfaces\SessionRepositoryInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ActivityLogger
{
    /**
     * @var AuthManager
     */
    private $auth;
    /**
     * @var SessionRepositoryInterface
     */
    private $repoSession;

    /**
     * ActivityLogger constructor.
     * @param AuthManager $auth
     * @param SessionRepositoryInterface $repoSession
     */
    public function __construct(
        AuthManager $auth,
        SessionRepositoryInterface $repoSession
    ) {
        $this->auth = $auth;
        $this->repoSession = $repoSession;
    }

    public function handle($request, Closure $next)
    {
        $session = $this->repoSession->findBySessionToken(session('user_session_token'));

        if ($session) {
            $session->updated_at = Carbon::now();
            $session->update();
        }

        $log = new Logger('user-activity-log');

        $handler = new RotatingFileHandler(storage_path() . '/logs/user_activity.log', 0, Logger::INFO, true, 0775);

        $handler->setFormatter(new LineFormatter("[%datetime%] %channel%.%level_name%: %message% \n"));

        $log->pushHandler($handler);

        if ($this->auth->user() === null) {
            $user_log = 'USER_ID: 0 | USER: guest | SESSION_TOKEN: no-session';
        } else {
            $user_log = 'USER_ID: ' . $this->auth->user()->id . ' | USER: ' . $this->auth->user()->name . ' ' . $this->auth->user()->email . ' | SESSION_TOKEN: ' . session('user_session_token');
        }

        $log->info($user_log . ' | METHOD: ' . $request->method() . ' | URL: ' . $request->path() . ' | IP: ' . $request->ip());


        return $next($request);

    }
}
