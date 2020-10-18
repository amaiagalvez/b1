<?php

namespace Izt\Basics\Notifications;

use App;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
            ->subject(trans('basics::passwords.reset_password_subject'))
            ->greeting(trans('basics::passwords.reset_password_greeting', ['name' => $notifiable->name]))
            ->line(trans('basics::passwords.reset_password_line_1'))
            ->action(trans('basics::passwords.reset_password'), url(route('password.reset',
                ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line(trans('basics::passwords.reset_password_line_2',
                ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
            ->line(trans('basics::passwords.reset_password_line_3'))
            ->salutation(trans('basics::passwords.reset_password_salutation'));

        App::setLocale($lang);

        return $mail;
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
