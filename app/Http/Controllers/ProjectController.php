<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Application;
use App\Models\Project;
use App\Models\Review;
use App\Models\Sprint;
use App\Models\User;
use App\Notifications\ProjectCreatedNotification;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $projects)
    {
        $user = auth()->user();

        $projects = $user->projects()
            ->withCount('applications')
            ->with(['applications' => function ($query) {
                $query->select('project_id', 'user_id');
            }])
            ->paginate(12);

        $client = $user->client;

        $verified = $client->verification_status;

        $reviewedProjectIds = Review::where('reviewer_id', $user->id)
            ->pluck('project_id')
            ->toArray();

        $projects->getCollection()->transform(function ($project) use ($reviewedProjectIds) {
            $project->has_reviewed = in_array($project->id, $reviewedProjectIds);

            return $project;
        });

        return view('projects.index', compact('projects', 'verified'));
    }

    public function projectFilter(Request $request)
    {
        $user = auth()->user();

        $query = Project::query()
            ->where('user_id', $user->id);

        if ($request->has('status')) {
            $query->where('project_status', $request->status);
        }

        $verified = $user->client->verification_status;

        $projects = $query->paginate(9);

        $reviewedProjectIds = Review::where('reviewer_id', $user->id)
            ->pluck('project_id')
            ->toArray();

        $projects->getCollection()->transform(function ($project) use ($reviewedProjectIds) {
            $project->has_reviewed = in_array($project->id, $reviewedProjectIds);

            return $project;
        });

        return view('projects.index', [
            'projects' => $projects,
            'verified' => $verified,
        ]);
    }

    public function displayProjects()
    {
        $userId = auth()->id();

        $projects = Project::with(['applications' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])
            ->where('project_status', 'Pending')
            ->orderBy('created_at', 'DESC')
            ->withCount('applications')
            ->paginate();

        return view('projects.display', compact('projects'));
    }

    public function viewProjects($id)
    {

        $projects = Project::findOrFail($id);

        $user = $projects->user;

        $client = $user->client;

        $translator = auth()->user()->id;

        $alreadyApplied = Application::where('project_id', $id)
            ->where('user_id', $translator)
            ->exists();

        return view('projects.show', compact('projects', 'user', 'client', 'alreadyApplied'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = \Str::slug($validated['project_name']);
        $project = Project::create($validated);

        // Notify all translators
        $translators = User::where('role', 'translator')->get();
        foreach ($translators as $translator) {
            $translator->notify(new ProjectCreatedNotification($project));
        }

        return redirect()->route('projects.index')
            ->with('flash.banner', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', [
            'projects' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();
        $validated['slug'] = \Str::slug($validated['project_name']);
        $project->update($validated);

        return redirect()->route('projects.index')
            ->with('flash.banner', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('flash.banner', 'Project deleted successfully');

    }

    public function search(Request $request)
    {
        $search = $request->search;

        if (empty($search)) {
            return redirect()->route('projects.display-projects');
        }

        $query = Project::query();

        $query->whereAny(['project_name', 'project_domain', 'original_language', 'target_language'], 'LIKE', "%$search%");

        $projects = $query->paginate();

        return view('projects.display', compact('projects'));
    }

    public function filter(Request $request)
    {

        $original_language = $request->original_language;
        $target_language = $request->target_language;

        if (empty($original_language) || empty($target_language)) {
            return redirect()->route('projects.display-projects');
        }

        $projects = Project::where('original_language', $original_language)
            ->where('target_language', $target_language)
            ->paginate();

        return view('projects.display', compact('projects'));

    }

    public function updateStatus(Request $request, Project $project)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,In Progress,Completed,Cancelled',
        ]);

        // Update project status
        $project->update(['project_status' => $request->status]);

        if ($request->status === 'Completed') {
            $project->applications()->update(['status' => 'Completed']);

        }

        return redirect()->route('projects.index')->with('success', 'Project status updated successfully.');
    }

    public function sentApplications()
    {
        $userId = auth()->id();

        $projects = Project::whereHas('applications', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('status', 'Pending');
        })
            ->withCount('applications')
            ->orderBy('created_at', 'DESC')
            ->paginate();

        return view('projects.display', compact('projects'));
    }

    public function acceptedApplications()
    {
        $userId = auth()->id();

        $projects = Project::whereHas('applications', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('status', 'Accepted');
        })
            ->orderBy('created_at', 'DESC')->paginate();

        return view('projects.display', compact('projects'));
    }

    public function completedApplications()
    {
        $userId = auth()->id();

        $projects = Project::whereHas('applications', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('status', 'Completed');
        })
            ->orderBy('created_at', 'DESC')->paginate();

        $user = auth()->user();

        $reviewedProjectIds = Review::where('reviewer_id', $user->id)
            ->pluck('project_id')
            ->toArray();

        $projects->getCollection()->transform(function ($project) use ($reviewedProjectIds) {
            $project->has_reviewed = in_array($project->id, $reviewedProjectIds);

            return $project;
        });

        return view('projects.display', compact('projects'));
    }

    public function projectManagement()
    {
        $userId = auth()->id();


        $projects = Project::whereHas('applications', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('status', 'Accepted');
        })
            ->with('sprints.feedback')
            ->paginate(10);

        return view('projects.management', compact('projects'));
    }

    public function setSprints(Request $request, Project $project)
    {
        if ($project->sprints()->count() > 0) {
            return redirect()->route('projects.management')->with('error', 'Phases have already been set for this project.');
        }

        $request->validate([
            'number_of_sprints' => 'required|integer|min:1',
        ]);

        // Create sprints for the project
        for ($i = 1; $i <= $request->number_of_sprints; $i++) {
            $project->sprints()->create(['sprint_number' => $i]);
        }

        return redirect()->route('projects.management')->with('success', 'Phases set successfully.');
    }

    public function updateSprintProgress(Request $request, Sprint $sprint)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'progress_document' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $path = $sprint->progress_document;

        if ($request->hasFile('progress_document')) {
            $path = $request->file('progress_document')->store('progress_documents', 'public');
        }

        $sprint->update([
            'description' => $request->description,
            'progress_document' => $path,
        ]);

        return redirect()->route('projects.management')->with('success', 'Phase progress updated successfully.');
    }

    public function editSprint(Sprint $sprint)
    {
        return view('sprints.edit', compact('sprint'));
    }

    public function updateSprint(Request $request, Sprint $sprint)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'progress_document' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $path = $sprint->progress_document;

        if ($request->hasFile('progress_document')) {
            $path = $request->file('progress_document')->store('progress_documents', 'public');
        }
        $sprint->update([
            'description' => $request->description,
            'progress_document' => $path,
        ]);

        return redirect()->route('projects.management')->with('success', 'Phase updated successfully.');
    }
}
