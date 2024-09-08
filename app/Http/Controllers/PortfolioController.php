<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portfolios.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePortfolioRequest $request)
    {
        $validated = $request->validated();

        $validated['translator_id'] = auth()->user()->translator->id;

        $validated['media'] = $this->uploadMedia($request->file('media'));

        // Create portfolio
        Portfolio::create($validated);

        return redirect()->route('translators.show', auth()->user()->translator)
            ->with('flash.banner', 'Portfolio item added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $portfolio = Portfolio::find($id);

        if (! $portfolio) {
            return response()->json(['message' => 'Portfolio not found'], 404);
        }

        return response()->json($portfolio);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portfolio $portfolio)
    {
        $translator = auth()->user()->translator;

        return view('portfolios.edit', compact('portfolio', 'translator'));
    }

    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio)
    {
        $validated = $request->validated();

        if ($request->hasFile('media')) {
            $validated['media'] = $this->uploadMedia($request->file('media'));
        }

        $validated['translator_id'] = auth()->user()->translator->id;

        // Update portfolio
        $portfolio->update($validated);

        return redirect()->route('translators.show', auth()->user()->translator)
            ->with('flash.banner', 'Portfolio item updated successfully');
    }

    private function uploadMedia($files)
    {
        $paths = [];
        if ($files) {
            foreach ($files as $file) {
                $paths[] = $file->store('portfolio_media', 'public');
            }
        }

        return $paths;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        //
    }
}
