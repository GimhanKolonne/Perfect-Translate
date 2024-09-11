<?php

    namespace App\Notifications;

    use Illuminate\Notifications\Notification;
    use Illuminate\Support\Facades\URL;

    class UserTypeNotification extends Notification
    {
        protected $role;
        protected $userId;

        public function __construct(string $role, int $userId)
        {
            $this->role = strtolower($role);
            $this->userId = $userId;
        }

        public function via($notifiable): array
        {
            return ['database'];
        }

        public function toDatabase($notifiable): array
        {
            return [
                'title' => 'Welcome, ' . ucfirst($this->role) . '!',
                'body' => "You've successfully joined as a " . ucfirst($this->role) . ".",
                'message' => 'Start exploring our platform now!',
                'profile_url' => $this->getProfileUrl(),
                'icon' => 'user-circle',
                'created_at' => now()->toISOString(),
            ];
        }

        public function toArray($notifiable): array
        {
            return $this->toDatabase($notifiable);
        }

        protected function getProfileUrl(): string
        {
            if ($this->role === 'client') {
                return URL::to("/clients/{$this->userId}");
            } elseif ($this->role === 'translator') {
                return URL::to("/translators/{$this->userId}");
            }

            return URL::route('home');
        }
    }
