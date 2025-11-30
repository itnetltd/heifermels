<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\Project;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::orderBy('code')->get();

        $indicators = Indicator::with('project')
            ->when($request->project_id, fn ($q) => $q->where('project_id', $request->project_id))
            ->orderBy('project_id')
            ->orderBy('code')
            ->paginate(20);

        return view('indicators.index', compact('indicators', 'projects'));
    }

    public function create()
    {
        $projects = Project::orderBy('code')->get();

        return view('indicators.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id'     => 'required|exists:projects,id',
            'code'           => 'required|string|max:50',
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'unit'           => 'nullable|string|max:50',
            'data_type'      => 'required|string|max:20',
            'frequency'      => 'nullable|string|max:20',
            'baseline_value' => 'nullable|numeric',
            'target_value'   => 'nullable|numeric',
            'is_kpi'         => 'sometimes|boolean',
            'is_active'      => 'sometimes|boolean',
        ]);

        // Ensure code is unique within project
        $exists = Indicator::where('project_id', $data['project_id'])
            ->where('code', $data['code'])
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['code' => 'This indicator code already exists for the selected project.'])
                ->withInput();
        }

        $data['is_kpi'] = $request->boolean('is_kpi');
        $data['is_active'] = $request->boolean('is_active');

        Indicator::create($data);

        return redirect()->route('indicators.index')
            ->with('status', 'Indicator created successfully.');
    }

    public function edit(Indicator $indicator)
    {
        $projects = Project::orderBy('code')->get();

        return view('indicators.edit', compact('indicator', 'projects'));
    }

    public function update(Request $request, Indicator $indicator)
    {
        $data = $request->validate([
            'project_id'     => 'required|exists:projects,id',
            'code'           => 'required|string|max:50',
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'unit'           => 'nullable|string|max:50',
            'data_type'      => 'required|string|max:20',
            'frequency'      => 'nullable|string|max:20',
            'baseline_value' => 'nullable|numeric',
            'target_value'   => 'nullable|numeric',
            'is_kpi'         => 'sometimes|boolean',
            'is_active'      => 'sometimes|boolean',
        ]);

        // Check duplicate code within project (ignoring current row)
        $exists = Indicator::where('project_id', $data['project_id'])
            ->where('code', $data['code'])
            ->where('id', '!=', $indicator->id)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['code' => 'This indicator code already exists for the selected project.'])
                ->withInput();
        }

        $data['is_kpi'] = $request->boolean('is_kpi');
        $data['is_active'] = $request->boolean('is_active');

        $indicator->update($data);

        return redirect()->route('indicators.index')
            ->with('status', 'Indicator updated successfully.');
    }

    public function destroy(Indicator $indicator)
    {
        $indicator->delete();

        return redirect()->route('indicators.index')
            ->with('status', 'Indicator deleted.');
    }
}
