<?php

namespace Izt\Users\Listeners;

use Izt\Users\Storage\Interfaces\SessionRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Auth\Events\Logout;


class LogSuccessfulLogout
{
    /**
     * @var SessionRepositoryInterface
     */
    private $repoSession;

    /**
     * Create the event listener.
     *
     * @param SessionRepositoryInterface $repoSession
     */
    public function __construct(
        SessionRepositoryInterface $repoSession
    ) {
        $this->repoSession = $repoSession;
    }

    /**
     * Handle the event.
     *
     * @param Logout $event
     * @return void
     */
    public function handle(Logout $event)
    {
        if ($event->user !== null) {

            $login = $this->repoSession->findBySessionToken(session('user_session_token'));

            if ($login) {
                $login->logout_at = Carbon::now();
                $login->save();
            }
        }
    }
}
