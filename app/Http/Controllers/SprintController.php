<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Sprint;
use Illuminate\Http\Request;

class SprintController extends Controller
{

    public function storeFeedback(Request $request, Sprint $sprint)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        Feedback::create([
            'sprint_id' => $sprint->id,
            'client_name' => auth()->user()->name,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully.');
    }
}
