<?php

namespace App\Notifications;

use App\Models\Drawing;
use App\Models\Invitee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class YouveDrawnAName extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invitee $receiver, Drawing $drawing)
    {
        $this->receiver = $receiver;
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
        $receiver = $this->receiver;
        $message = $notifiable->id == $receiver->id ? "Hey $notifiable->name! You've drawn a name. You are giving a gift to whomever you would like in $drawing->name." : "Hey $notifiable->name! You've drawn a name. You are giving a gift to $receiver->name in $drawing->name.";
        return (new MailMessage)
                    ->subject('You\'ve Drawn a Name!')
                    ->line($message)
                    ->action('View', url(route('drawings.draw', [$this->drawing->id, $notifiable])))
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
