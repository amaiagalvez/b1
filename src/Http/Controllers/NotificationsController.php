<?php

namespace Izt\Users\Http\Controllers;

use Izt\Users\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    /**
     * NotificationsController constructor.
     */
    public function __construct()
    {
    }

    public function index()
    {
        return Auth::user()->notifications;
    }

    public function update(DatabaseNotification $notification)
    {
        if (empty($notification->read_at)) {
            $notification->markAsRead();
        } else {
            $notification->markAsUnread();
        }

        return $notification->fresh();
    }
}
