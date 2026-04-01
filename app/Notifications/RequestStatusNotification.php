<?php

namespace App\Notifications;

use App\Models\MessageRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RequestStatusNotification extends Notification
{
    use Queueable;

    public function __construct(protected MessageRequest $request, protected string $status) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        $isRejected = $this->status === 'rejected';
        $title = $isRejected ? 'Connection Request Rejected' : 'Connection Request Update';
        $message = $isRejected
            ? 'Your connection request to ' . $this->request->receiver->name . ' was rejected. You may send a new request.'
            : 'Your connection request status has changed to: ' . ucfirst($this->status) . '.';

        return [
            'title' => $title,
            'message' => $message,
            'type' => $isRejected ? 'danger' : 'success',
            'icon' => $isRejected ? 'tabler:ban' : 'tabler:check',
            'notification_type' => 'request_status',
            'request_id' => $this->request->id,
            'sender_id' => $this->request->sender_id,
            'receiver_id' => $this->request->receiver_id,
        ];
    }
}
