<?php

namespace Fpaipl\Panel\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminNotification extends Notification implements ShouldQueue
{
    use Queueable; 
 
    public function __construct(
        protected string $title,
        protected string $message,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'action' => route('panel.dashboard'),
            'title' => $this->title,
            'message' => $this->message,
            'time' => now()->toDateTimeString(),
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject($this->title)
                ->markdown('panel::mail.admin-alert', ['message' => $this->message]);
    }
}
