<?php

namespace App\Http\Controllers;

use App\Notifications\ApplicationNotification;
use App\Notifications\ProjectCreatedNotification;
use App\Notifications\UserTypeNotification;
use App\Notifications\WelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(10);
        return view('home', compact('notifications'));
    }

    public function apiIndex()
    {
        return Auth::user()->notifications()->latest()->take(5)->get();
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();

        return response()->json(['success' => true]);
    }

    protected function getNotificationUrl($notification)
    {
        switch (get_class($notification->type)) {
            case WelcomeNotification::class:
            case UserTypeNotification::class:
                return $notification->data['profile_url'] ?? route('home');
            case ProjectCreatedNotification::class:
                return route('projects.show', $notification->data['project_id']);
            case ApplicationNotification::class:
                return route('applications.show', $notification->data['application_id']);
            default:
                return route('home');
        }
    }

    protected function getNotificationIcon($notification)
    {
        switch (get_class($notification->type)) {
            case WelcomeNotification::class:
            case UserTypeNotification::class:
                return 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z';
            case ProjectCreatedNotification::class:
                return 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01';
            case ApplicationNotification::class:
                return 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z';
            default:
                return 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
        }
    }
}
