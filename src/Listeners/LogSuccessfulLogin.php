<?php

namespace Izt\Users\Listeners;

use Izt\Users\Storage\Interfaces\SessionRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LogSuccessfulLogin
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var SessionRepositoryInterface
     */
    private $repoSession;

    /**     *
     * LogSuccessfulLogin constructor.
     * @param Request $request
     * @param SessionRepositoryInterface|null $repoSession
     */
    public function __construct(
        Request $request,
        SessionRepositoryInterface $repoSession = null
    ) {
        $this->request = $request;
        $this->repoSession = $repoSession;
    }

    /**
     * Handle the event.
     *
     * @param Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        $sessionToken = md5(Carbon::now() . Str::random(10));
        $this->request->session()->put('user_session_token', $sessionToken);

        $session = [
            'user_id' => $event->user->id ?? 0,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'session_token' => session('user_session_token'),
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            'login_at' => Carbon::now()
        ];

        $this->repoSession->create($session);
    }
}
