<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class NewMessageNotification extends Notification
{
    use Queueable;

    public function __construct(protected $messageData) {}

    public function via($notifiable): array
    {
        return ['database']; // Stores in your notifications table
    }

    public function toArray($notifiable): array
    {
        $senderId = (string) $notifiable->getKey() === (string) $this->messageData->coach_id
            ? $this->messageData->seeker_id
            : $this->messageData->coach_id;

        return [
            'title'     => 'New Message',
            'seeker_id' => $this->messageData->seeker_id,
            'coach_id'  => $this->messageData->coach_id,
            'sender_id' => $senderId,
            'message'   => Str::limit($this->messageData->message, 80),
            'type'      => 'primary',
            'icon'      => 'tabler:message-circle',
            'notification_type' => 'chat_message',
        ];
    }
}
