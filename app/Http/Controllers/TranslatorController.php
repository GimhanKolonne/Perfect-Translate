<?php

namespace App\Http\Controllers;

use App\Models\Translator;
use App\Http\Requests\StoreTranslatorRequest;
use App\Http\Requests\UpdateTranslatorRequest;

class TranslatorController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('translators.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTranslatorRequest $request)
    {
        // Get the validated data
        $validated = $request->validated();


        $validated['slug'] = \Str::slug($validated['bio']);

        // Serialize arrays
        $validated['type_of_translator'] = json_encode($validated['type_of_translator']);
        $validated['language_pairs'] = json_encode($validated['language_pairs']);

        // Create the translator
        Translator::create($validated);

        $user = auth()->user();
        $user->update(['role' => 'translator']);

        $translator = auth()->user()->translator;

        return redirect()->route('home')
            ->with('flash.banner', 'Profile created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Translator $translator)
    {
        return view('translators.show', compact('translator'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Translator $translator)
    {
        // Decode JSON strings to arrays
        $translator->type_of_translator = json_decode($translator->type_of_translator, true) ?? [];
        $translator->language_pairs = json_decode($translator->language_pairs, true) ?? [];

        return view('translators.edit', compact('translator'));
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTranslatorRequest $request, Translator $translator)
    {
        $validated = $request->validated();

        $validated['slug'] = \Str::slug($validated['bio']);

        // Ensure these are arrays before encoding
        $validated['type_of_translator'] = json_encode($validated['type_of_translator'] ?? []);
        $validated['language_pairs'] = json_encode($validated['language_pairs'] ?? []);

        $translator->update($validated);

        return redirect()->route('translators.show', $translator)
            ->with('flash.banner', 'Profile updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Translator $translator)
    {
        //
    }
}
