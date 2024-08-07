<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = auth()->user();
        $projects = $client->projects()->paginate(10); // Retrieve the client's projects and paginate

        return view('projects.index', compact('projects'));
    }

    public function displayProjects()
    {
        $projects = Project::orderBy('created_at', 'DESC')->paginate();

        return view('projects.display', compact('projects'));

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
        Project::create($validated);

        return redirect()->route('projects.index')
            ->with('flash.banner', 'Project created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

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
        //destroy project
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
}
