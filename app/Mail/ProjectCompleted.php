<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $project;

    /**
     * Create a new message instance.
     *
     * @param  Project  $project
     */
    public function __construct($project)
    {
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Project Completed')
            ->view('emails.project_completed');
    }
}
