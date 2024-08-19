<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentUploadedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('Document Uploaded - Verification Pending')
            ->markdown('emails.document-uploaded');
    }
}
