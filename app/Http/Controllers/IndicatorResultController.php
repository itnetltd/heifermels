<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\IndicatorResult;
use App\Models\Project;
use Illuminate\Http\Request;

class IndicatorResultController extends Controller
{
    public function index(Request $request)
    {
        $projects   = Project::orderBy('code')->get();
        $indicators = Indicator::orderBy('code')->get();

        $results = IndicatorResult::with(['project', 'indicator'])
            ->when($request->project_id, fn ($q) =>
                $q->where('project_id', $request->project_id)
            )
            ->when($request->indicator_id, fn ($q) =>
                $q->where('indicator_id', $request->indicator_id)
            )
            ->orderByDesc('period_date')
            ->orderByDesc('id')
            ->paginate(20);

        return view('indicator_results.index', compact(
            'results',
            'projects',
            'indicators'
        ));
    }

    public function create()
    {
        $projects   = Project::orderBy('code')->get();
        $indicators = Indicator::orderBy('code')->get();

        return view('indicator_results.create', compact('projects', 'indicators'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id'   => 'required|exists:projects,id',
            'indicator_id' => 'required|exists:indicators,id',
            'period_date'  => 'required|date',
            'period_label' => 'nullable|string|max:50',
            'value'        => 'nullable|numeric',
            'value_text'   => 'nullable|string',
            'comment'      => 'nullable|string',
        ]);

        $data['created_by'] = $request->user()->id;

        IndicatorResult::create($data);

        return redirect()
            ->route('indicator-results.index')
            ->with('status', 'Result recorded successfully.');
    }

    public function edit(IndicatorResult $indicatorResult)
    {
        $projects   = Project::orderBy('code')->get();
        $indicators = Indicator::orderBy('code')->get();

        return view('indicator_results.edit', [
            'result'     => $indicatorResult,
            'projects'   => $projects,
            'indicators' => $indicators,
        ]);
    }

    public function update(Request $request, IndicatorResult $indicatorResult)
    {
        $data = $request->validate([
            'project_id'   => 'required|exists:projects,id',
            'indicator_id' => 'required|exists:indicators,id',
            'period_date'  => 'required|date',
            'period_label' => 'nullable|string|max:50',
            'value'        => 'nullable|numeric',
            'value_text'   => 'nullable|string',
            'comment'      => 'nullable|string',
        ]);

        $indicatorResult->update($data);

        return redirect()
            ->route('indicator-results.index')
            ->with('status', 'Result updated successfully.');
    }

    public function destroy(IndicatorResult $indicatorResult)
    {
        $indicatorResult->delete();

        return redirect()
            ->route('indicator-results.index')
            ->with('status', 'Result deleted.');
    }
}
