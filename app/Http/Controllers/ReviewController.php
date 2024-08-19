<?php

namespace App\Http\Controllers;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {


        // Validate the request data
        $validated = $request->validate([
            'reviewer_id' => 'required|exists:users,id',
            'reviewee_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'review' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Check if a review already exists for the given project by this reviewer
        $existingReview = Review::where('reviewer_id', $validated['reviewer_id'])
            ->where('reviewee_id', $validated['reviewee_id'])
            ->where('project_id', $validated['project_id'])
            ->exists();

        if ($existingReview) {
            return redirect()->back()->with('flash.banner', 'You have already reviewed this project.');
        }

            Review::create([
            'reviewer_id' => $validated['reviewer_id'],
            'reviewee_id' => $validated['reviewee_id'],
            'project_id' => $validated['project_id'],
            'review' => $validated['review'],
            'rating' => $validated['rating'],
        ]);

        return redirect()->back()->with('flash.banner', 'Reviewed Successfully');
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
    public function destroy(Review $review)
    {
        //
    }
}
