<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Mail\DocumentUploadedNotification;
use App\Models\Client;
use App\Models\Project;
use App\Models\Review;
use App\Models\Sprint;
use App\Models\User;
use App\Notifications\AdminNotificationForVerificationNotification;
use App\Notifications\UserTypeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class ClientController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    public function index()
    {
        $currentUserId = auth()->id();

        $clients = Client::whereHas('user', function ($query) use ($currentUserId) {
            $query->where('id', '!=', $currentUserId);
        })
            ->orderBy('created_at', 'DESC')
            ->paginate();

        return view('clients.index', compact('clients'));
    }

    public function displayProfile($id)
    {
        $client = Client::findOrFail($id);
        $reviews = Review::where('reviewee_id', $client->user_id)
            ->with('reviewer')
            ->latest()
            ->paginate(3);
        $averageRating = $client->reviews()->avg('rating') ?: 0;
        $reviewCount = $client->reviews()->count();

        return view('clients.display', compact('client', 'reviews', 'averageRating', 'reviewCount'));
    }

    public function search(Request $request)
    {
        $search = $request->search;

        if (empty($search)) {
            return redirect()->route('clients.index');
        }

        $query = Client::query();

        $query->whereAny(['contact_name', 'company_name'], 'LIKE', "%$search%");

        $clients = $query->paginate();

        return view('clients.index', compact('clients'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        // Get the validated data
        $validated = $request->validated();

        $validated['slug'] = \Str::slug($validated['company_name'] ?: $validated['contact_name']);

        // Create the client
        Client::create($validated);

        $user = auth()->user();
        $user->update(['role' => 'client']);

        $client = auth()->user()->client;

        $userId = $client->user_id;
        $user->notify(new UserTypeNotification('client', $userId));

        return redirect()->route('home')
            ->with('flash.banner', 'Profile created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {

        $averageRating = $client->reviews()->avg('rating') ?: 0;
        $reviewCount = $client->reviews()->count();
        $reviews = Review::where('reviewee_id', $client->user_id)
            ->with('reviewer')
            ->latest()
            ->paginate(5);

        return view('clients.show', compact('client', 'averageRating', 'reviewCount', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        // Get the validated data
        $validated = $request->validated();

        // Update the client
        $client->update($validated);

        return redirect()->route('clients.show', $client)
            ->with('flash.banner', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }

    public function uploadDocument(Request $request)
    {

        try {
            // Validate the request
            $request->validate([
                'documents.*' => [
                    'required',
                    'file',
                    'mimes:pdf',
                    'max:5120',
                ],
            ], [
                'documents.*.required' => 'Please select document files to upload.',
                'documents.*.file' => 'The uploaded file is not valid.',
                'documents.*.mimes' => 'Each document must be a PDF file.',
                'documents.*.max' => 'Each document file size must not exceed 5MB.',
            ]);

            $client = auth()->user()->client;

            // Check if a document has already been uploaded
            if ($client->document_path) {
                return redirect()->back()->with('error', 'A document has already been uploaded. Please contact support to update your document.');
            }

            if ($request->hasFile('documents')) {
                $paths = [];
                foreach ($request->file('documents') as $file) {
                    $path = $file->store('documents', 'public');
                    $paths[] = $path;
                }

                // Store paths as a JSON array
                $client->document_path = json_encode($paths);
                $client->verification_status = 'Pending';
                $client->save();

                // Send email notification
                Mail::to($client->user->email)->send(new DocumentUploadedNotification());
                $adminUsers = User::where('role', 'admin')->get();
                Notification::send($adminUsers, new AdminNotificationForVerificationNotification(auth()->user(), $client->document_path));


                return redirect()->back()->with('success', 'Documents uploaded successfully. Your profile is now pending verification.');
            }

            return redirect()->back()->with('error', 'Failed to upload document. Please try again.');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Document upload error: '.$e->getMessage());

            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    public function projectManagement()
    {
        $userId = Auth::id();

        $projects = Project::where('user_id', $userId)
            ->where('project_status', 'In Progress')
            ->with(['sprints', 'applications.user'])
            ->paginate(10);

        return view('clients.management', compact('projects'));
    }

    public function viewSprintProgress($sprintId)
    {
        $sprint = Sprint::with('project')->findOrFail($sprintId);

        return view('clients.sprints', compact('sprint'));
    }

    public function submitFeedback(Request $request, $sprintId)
    {


        $request->validate([
            'feedback' => 'required|string|max:500',
        ]);

        $sprint = Sprint::findOrFail($sprintId);
        $sprint->feedback = $request->feedback;
        $sprint->save();

        return redirect()->route('client.projects.management', $sprintId)->with('success', 'Feedback submitted successfully.');
    }
}
