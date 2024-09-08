<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    public function __construct() {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'title' => 'Welcome!',
            'body' => 'Thank you for registering at our website!',
            'message' => 'Start by completing your profile!',

        ];
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
