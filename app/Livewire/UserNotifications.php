<?php

namespace App\Livewire;

use Livewire\Component;

class UserNotifications extends Component
{
    public $notifications;

    public $unreadCount;

    public function mount()
    {
        $this->notifications = auth()->user()->notifications()->latest()->get();
        $this->unreadCount = auth()->user()->unreadNotifications()->count();
    }

    public function render()
    {
        return view('livewire.user-notifications', [
            'notifications' => $this->notifications,
            'unreadCount' => $this->unreadCount,
        ]);
    }
}
