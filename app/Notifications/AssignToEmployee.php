<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AssignToEmployee extends Notification
{
    use Queueable;

    public $announcementMessage;
    public $link;
    /**
     * Create a new notification instance.
     */
    public function __construct($link, $announcementMessage)
    {
        $this->link = $link;
        $this->announcementMessage = $announcementMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    public function toDatabase($notifiable)
    {
        $notificationTime = Carbon::now();
        $notificationTimeFormatted = $notificationTime->diffForHumans();

        return [
            'message' => $this->announcementMessage,
            'link' => $this->link,
            'time' => $notificationTimeFormatted,
        ];
    }
}
