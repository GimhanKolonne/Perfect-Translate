<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Mail\ApplicationAccepted;
use App\Mail\ApplicationDeclined;
use App\Models\Application;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showApplications($projectId, Request $request)
    {
        $project = Project::findOrFail($projectId);

        $status = $request->query('status');

        // Eager load the translator and user relationship
        $applicationsQuery = Application::with('translator.user')
            ->where('project_id', $projectId);

        // Apply status filter if a status is provided
        if ($status) {
            $applicationsQuery->where('status', $status);
        }

        $applications = $applicationsQuery->get();

        return view('applications.index', compact('project', 'applications'));
    }

    public function accept($id)
    {
        $application = Application::findOrFail($id);
        $project = $application->project;

        // Change the project status to "In Progress"
        $application->update(['status' => 'Accepted']);
        $project->update(['project_status' => 'In Progress']);

        // Send acceptance email
        Mail::to($application->translator->user->email)->send(new ApplicationAccepted($application, $project));

        return redirect()->back()->with('flash.banner', 'Application accepted, project is now in progress.');
    }

    public function decline($id)
    {
        $application = Application::findOrFail($id);
        $project = $application->project;

        // Change the application status to "Declined"
        $application->update(['status' => 'Declined']);
        $project->update(['project_status' => 'Pending']);

        // Send decline email
        Mail::to($application->translator->user->email)->send(new ApplicationDeclined($application));

        return redirect()->back()->with('flash.banner', 'Application declined.');
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApplicationRequest $request)
    {
        // Validate the request

        $validated = $request->validated();

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filePath = $file->store('cvs', 'public');
            $validated['cv'] = $filePath;

        } else {
            $validated['cv'] = null;
        }

        // Create the application
        Application::create($validated);

        return redirect()->route('projects.display-projects')
            ->with('flash.banner', 'Application sent');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return redirect()->back()->with('flash.banner', 'Application deleted successfully.');
    }
}
