<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Application;

class EnsureUserBelongsToProject
{
    public function handle(Request $request, Closure $next)
    {
        $projectId = $request->route('projectId');
        $user = auth()->user();

        $projectBelongsToUser = Project::where('id', $projectId)
            ->where('user_id', $user->id)
            ->exists();

        $userHasApplication = Application::where('project_id', $projectId)
            ->where('user_id', $user->id)
            ->exists();

        if (!$projectBelongsToUser && !$userHasApplication) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
