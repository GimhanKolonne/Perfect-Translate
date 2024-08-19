<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Mail\DocumentUploadedNotification;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        return view('clients.display', compact('client'));
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

        // Create the slug from the company name or another suitable field
        $validated['slug'] = \Str::slug($validated['company_name'] ?: $validated['contact_name']);

        // Create the client
        Client::create($validated);

        $user = auth()->user();
        $user->update(['role' => 'client']);

        $client = auth()->user()->client;

        return redirect()->route('home')
            ->with('flash.banner', 'Profile created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
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
                    'max:5120', // 5MB max file size per file
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

                return redirect()->back()->with('success', 'Documents uploaded successfully. Your profile is now pending verification.');
            }

            return redirect()->back()->with('error', 'Failed to upload document. Please try again.');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Document upload error: '.$e->getMessage());

            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
}
