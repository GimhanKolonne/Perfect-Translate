<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class UserTypeNotification extends Notification
{
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'title' => 'Congrats!',
            'body' => 'Thank you for becoming a '.$this->role.'!',
            'message' => 'You can now start using our platform!',
        ];
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => 'Congrats!',
            'body' => 'Thank you for becoming a '.$this->role.'!',
            'message' => 'You can now start using our platform!',

        ];
    }
}
