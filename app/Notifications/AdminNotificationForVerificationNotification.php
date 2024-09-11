<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class AdminNotificationForVerificationNotification extends Notification
{
    protected $user;
    protected $documentPath;

    public function __construct(User $user, string $documentPath)
    {
        $this->user = $user;
        $this->documentPath = $documentPath;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        // Generate the action URL based on the user's role
        $reviewUrl = $this->user->role === 'translator'
            ? url('/admin/translators')
            : url('/admin/clients');

        return (new MailMessage)
            ->subject('New Document Uploaded for Verification')
            ->line("User {$this->user->name} (ID: {$this->user->id}) has uploaded a document for verification.")
            ->action('Review Document', $reviewUrl) // Review button
            ->line('Please review the document and take appropriate action.');
    }

    public function toArray($notifiable): array
    {
        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'document_path' => $this->documentPath,
        ];
    }
}
