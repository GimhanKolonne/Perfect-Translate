<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
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
