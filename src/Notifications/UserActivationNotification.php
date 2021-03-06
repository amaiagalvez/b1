<?php

namespace Izt\Basics\Notifications;

use App;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class UserActivationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $lang = App::getLocale();

        App::setLocale($notifiable->lang ?? 'eu');

        $mail = (new MailMessage())
            ->subject(trans('basics::auth.verify_email'))
            ->greeting(trans('basics::auth.verify_email_greeting', ['name' => $notifiable->name]))
            ->line(trans('basics::auth.verify_email_line_1'))
            ->action(
                trans('basics::auth.verify_email'),
                $this->verificationUrl($notifiable)
            )
            ->line(trans('basics::auth.verify_email_line_2',
                ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
            ->line(trans('basics::auth.verify_email_line_3'))
            ->salutation(trans('basics::auth.verify_email_salutation'));

        App::setLocale($lang);

        return $mail;
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
