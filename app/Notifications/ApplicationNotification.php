<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationNotification extends Notification
{
    protected $application;
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function via($notifiable): array
    {
        return [ 'database'];
    }



    public function toArray($notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'project_id' => $this->application->project->id,
            'project_name' => $this->application->project->project_name,
            'translator_id' => $this->application->translator->id,
            'translator_name' => $this->application->translator->user->name,
        ];
    }
}
