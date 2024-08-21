<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Project;
use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $application = Application::where('project_id', $project->id)
            ->where('status', 'Completed')
            ->firstOrFail();

        return view('reviews.create', compact('application', 'project'));
    }

    public function createMethod(Project $project)
    {
        $application = Application::where('project_id', $project->id)
            ->where('status', 'Completed')
            ->firstOrFail();

        return view('reviews.create.translator', compact('application', 'project'));
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreReviewRequest $request)
    {
        $validated = $request->validated();

        Review::create($validated);

        $review = new Review();
        $review->reviewer_id = $validated['reviewer_id'];
        $review->reviewee_id = $validated['reviewee_id'];
        $review->project_id = $validated['project_id'];
        $review->rating = $validated['rating'];
        $review->review = $validated['review'];


        $user = auth()->user();

        $role = $user->role;


        if ($role === 'client') {
            return redirect()->route('projects.index')
                ->with('flash.banner', 'Reviewed successfully');
        }
        else {
            return redirect()->route('projects.display-projects')
                ->with('flash.banner', 'Reviewed successfully');
        }

    }










    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Delete the review
        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }

}