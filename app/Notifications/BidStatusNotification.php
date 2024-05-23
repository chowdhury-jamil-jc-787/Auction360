<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BidStatusNotification extends Notification
{
    use Queueable;
    private $offerData;

    /**
     * Create a new notification instance.
     */
    public function __construct($offerData)
    {
        $this->offerData = $offerData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->name($this->offerData['name'])
            ->line($this->offerData['body'])
            ->action($this->offerData['offerText'], $this->offerData['offerUrl'])
            ->line($this->offerData['thanks']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'offer_id' => $this->offerData['offer_id']
        ];
    }
}
