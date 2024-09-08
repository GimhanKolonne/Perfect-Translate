<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProjectCreatedNotification extends Notification
{
    use Queueable;

    protected $project;

    public function __construct($project)
    {
        $this->project = $project;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Project Created',
            'body' => 'A new project named "'.$this->project->project_name.'" has been created.',
            'message' => 'Check it out!',
            'project_id' => $this->project->id,
        ];
    }
}
