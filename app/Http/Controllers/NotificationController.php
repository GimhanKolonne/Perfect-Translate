<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;
        $unreadCount = auth()->user()->unreadNotifications->count();

        return view('notification', compact('notifications', 'unreadCount'));
    }
}
