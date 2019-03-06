<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('Solicitud de restablecimiento de contraseña')
                    ->greeting('Hola '. $notifiable->name)
                    ->line('Ud. ha solicitado cambio de contraseña. Continue dando click en el siguiente botón.')
                    ->action(Lang::getFromJson('Reiniciar Contraseña'), url(config('app.url').route('password.reset', $this->token, false)))
                    ->line(Lang::getFromJson('Esta solicitud expira en :count minutos.', ['count' => config('auth.passwords.users.expire')]))
                    ->line('Si no solicitó un restablecimiento de contraseña, no es necesario realizar ninguna otra acción.')
                    ->salutation(Lang::getFromJson("Atentamente\n" .config('app.name')));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
