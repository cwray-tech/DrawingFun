<?php

namespace App\Notifications;

use App\Models\Drawing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitedToDrawing extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Drawing $drawing)
    {
        $this->drawing = $drawing;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
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
        $drawing = $this->drawing;
        return (new MailMessage)
                    ->subject('Invitation to Drawing')
                    ->line("Hey $notifiable->name! You've been invited to $drawing->name")
                    ->action('Draw your name', url(route('drawings.draw', [$this->drawing, $notifiable])))
                    ->line('Happy Holiday\'s!');
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
