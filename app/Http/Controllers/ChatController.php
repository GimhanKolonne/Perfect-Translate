<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Project;
use App\Models\ProjectFile;
use Illuminate\Http\Request;
use Pusher\Pusher;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function index($projectId)
    {
        $messages = Message::where('project_id', $projectId)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $project = Project::findOrFail($projectId);
        $project_name = $project->project_name;
        $project_user_id = $project->user_id;


        return view('chat.index', [
            'projectId' => $projectId,
            'pusherKey' => config('broadcasting.connections.pusher.key'),
            'pusherCluster' => config('broadcasting.connections.pusher.options.cluster'),
            'messages' => $messages,
            'project_name' => $project_name,
            'user_id' => $project_user_id
        ]);
    }

    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->user_name = $request->user()->name;
        $message->message = $request->message;
        $message->project_id = $request->project_id;

        $message->save();

        $this->triggerPusherEvent($message);

        return response()->json(['status' => 'Message sent successfully']);
    }

    public function fetchMessages($projectId)
    {
        return Message::where('project_id', $projectId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function uploadFile(Request $request, $projectId)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
        ]);

        $project = Project::findOrFail($projectId);
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $filepath = $file->store('project_files/' . $project->id, 'public');

        // Create the project file record
        $projectFile = ProjectFile::create([
            'project_id' => $project->id,
            'user_id' => auth()->id(),
            'filename' => $filename,
            'filepath' => $filepath,
        ]);

        $message = new Message();
        $message->user_name = auth()->user()->name;
        $message->message = "Uploaded file: $filename";
        $message->project_id = $project->id;
        $message->project_file_id = $projectFile->id; // Save the project_file_id
        $message->save();

        // Trigger the Pusher event for new message
        $this->triggerPusherEvent($message);

        return response()->json([
            'id' => $projectFile->id,
            'filename' => $filename,
            'url' => Storage::url($filepath),
            'user_id' => auth()->id()
        ]);
    }

    public function getProjectFiles($projectId)
    {
        $files = ProjectFile::where('project_id', $projectId)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($file) {
                return [
                    'id' => $file->id,
                    'filename' => $file->filename,
                    'url' => Storage::url($file->filepath),
                    'user_id' => $file->user_id,
                ];
            });

        return response()->json($files);
    }

    public function deleteFile($fileId)
    {
        $file = ProjectFile::findOrFail($fileId);

        // Check if the authenticated user is the one who uploaded the file
        if ($file->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized to delete this file.'], 403);
        }

        Storage::delete($file->filepath);
        $file->delete();

        return response()->json(['message' => 'File deleted successfully']);
    }

    private function triggerPusherEvent($message)
    {
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

        $pusher->trigger('chat-channel', 'chat-event', [
            'user_name' => $message->user_name,
            'message' => $message->message,
            'project_id' => $message->project_id,
            'project_file_id' => $message->project_file_id,
            'user_id' => auth()->id()
        ]);
    }
}
