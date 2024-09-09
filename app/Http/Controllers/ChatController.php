<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Project;
use Illuminate\Http\Request;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function index($projectId)
    {
        $messages = Message::where('project_id', $projectId)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $project_name = Project::find($projectId)->project_name;

        return view('chat.index', [
            'projectId' => $projectId,
            'pusherKey' => config('broadcasting.connections.pusher.key'),
            'pusherCluster' => config('broadcasting.connections.pusher.options.cluster'),
            'messages' => $messages,
            'project_name' => $project_name
        ]);
    }

    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->user_name = $request->user()->name;
        $message->message = $request->message;
        $message->project_id = $request->project_id;

        $message->save();

        // Set up Pusher
        $options = [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => true,
        ];
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            $options
        );

        // Trigger a Pusher event
        $pusher->trigger('chat-channel', 'chat-event', [
            'user_name' => $message->user_name,
            'message' => $message->message,
            'project_id' => $message->project_id
        ]);
    }

    public function fetchMessages($projectId)
    {
        return Message::where('project_id', $projectId)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
    }
}
