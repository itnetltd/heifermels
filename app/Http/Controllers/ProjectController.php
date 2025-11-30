<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('code')->paginate(10);

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code'              => 'required|string|max:50|unique:projects,code',
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'start_date'        => 'nullable|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
            'target_households' => 'nullable|integer|min:0',
        ]);

        Project::create($data);

        return redirect()->route('projects.index')
            ->with('status', 'Project created successfully.');
    }

    /**
     * Display a single project with its indicators overview.
     */
    public function show(Project $project)
    {
        // Load indicators + their results for this project
        $indicators = $project->indicators()
            ->with('results')
            ->orderBy('code')
            ->get();

        return view('projects.show', compact('project', 'indicators'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'code'              => 'required|string|max:50|unique:projects,code,' . $project->id,
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'start_date'        => 'nullable|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
            'target_households' => 'nullable|integer|min:0',
        ]);

        $project->update($data);

        return redirect()->route('projects.index')
            ->with('status', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('status', 'Project deleted.');
    }
}
