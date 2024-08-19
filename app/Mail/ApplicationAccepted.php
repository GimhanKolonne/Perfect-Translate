<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public $project;

    /**
     * Create a new message instance.
     *
     * @param  Project  $project
     */
    public function __construct(Application $application, $project)
    {
        $this->application = $application;
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Application Accepted')
            ->view('emails.application_accepted');
    }
}
