<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ProjectCompletedNotification extends Notification
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

    public function toArray($notifiable)
    {
        return [
            'title' => 'Project Completed',
            'body' => 'The project "' . $this->project->project_name . '" has been marked as completed.', // Notification message
            'project_id' => $this->project->id,
            'project_name' => $this->project->project_name,
            'status' => 'Completed',
        ];
    }
}
