<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

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
        return view('clients.index', [
            'clients' => Client::orderBy('created_at', 'DESC')->paginate(),
        ]);
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
}
