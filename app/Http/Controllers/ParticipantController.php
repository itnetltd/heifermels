<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::orderBy('code')->get();

        $participants = Participant::with('project')
            ->when($request->project_id, fn ($q) => $q->where('project_id', $request->project_id))
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('participants.index', compact('participants', 'projects'));
    }

    public function create()
    {
        $projects = Project::orderBy('code')->get();

        return view('participants.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id'      => 'required|exists:projects,id',
            'participant_uid' => 'nullable|string|max:50|unique:participants,participant_uid',
            'full_name'       => 'nullable|string|max:255',
            'gender'          => 'nullable|string|max:10',
            'date_of_birth'   => 'nullable|date',
            'phone'           => 'nullable|string|max:50',
            'national_id'     => 'nullable|string|max:50',
            'province'        => 'nullable|string|max:100',
            'district'        => 'nullable|string|max:100',
            'sector'          => 'nullable|string|max:100',
            'cell'            => 'nullable|string|max:100',
            'village'         => 'nullable|string|max:100',
            'is_youth'        => 'sometimes|boolean',
            'is_person_with_disability' => 'sometimes|boolean',
        ]);

        // ✅ Extra duplicate check: same National ID in same project
        if (!empty($data['national_id'])) {
            $exists = Participant::where('project_id', $data['project_id'])
                ->where('national_id', $data['national_id'])
                ->exists();

            if ($exists) {
                return back()
                    ->withErrors([
                        'national_id' => 'A participant with this National ID is already registered in this project.',
                    ])
                    ->withInput();
            }
        }

        // Auto-generate UID if not provided
        if (empty($data['participant_uid'])) {
            $data['participant_uid'] = 'HR-' . strtoupper(Str::random(8));
        }

        $data['is_youth'] = $request->boolean('is_youth');
        $data['is_person_with_disability'] = $request->boolean('is_person_with_disability');

        Participant::create($data);

        return redirect()->route('participants.index')
            ->with('status', 'Participant created successfully.');
    }

    public function edit(Participant $participant)
    {
        $projects = Project::orderBy('code')->get();

        return view('participants.edit', compact('participant', 'projects'));
    }

    public function update(Request $request, Participant $participant)
    {
        $data = $request->validate([
            'project_id'      => 'required|exists:projects,id',
            'participant_uid' => 'required|string|max:50|unique:participants,participant_uid,' . $participant->id,
            'full_name'       => 'nullable|string|max:255',
            'gender'          => 'nullable|string|max:10',
            'date_of_birth'   => 'nullable|date',
            'phone'           => 'nullable|string|max:50',
            'national_id'     => 'nullable|string|max:50',
            'province'        => 'nullable|string|max:100',
            'district'        => 'nullable|string|max:100',
            'sector'          => 'nullable|string|max:100',
            'cell'            => 'nullable|string|max:100',
            'village'         => 'nullable|string|max:100',
            'is_youth'        => 'sometimes|boolean',
            'is_person_with_disability' => 'sometimes|boolean',
        ]);

        // ✅ SAME duplicate rule when editing (ignore current record)
        if (!empty($data['national_id'])) {
            $exists = Participant::where('project_id', $data['project_id'])
                ->where('national_id', $data['national_id'])
                ->where('id', '!=', $participant->id)
                ->exists();

            if ($exists) {
                return back()
                    ->withErrors([
                        'national_id' => 'A participant with this National ID is already registered in this project.',
                    ])
                    ->withInput();
            }
        }

        $data['is_youth'] = $request->boolean('is_youth');
        $data['is_person_with_disability'] = $request->boolean('is_person_with_disability');

        $participant->update($data);

        return redirect()->route('participants.index')
            ->with('status', 'Participant updated successfully.');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();

        return redirect()->route('participants.index')
            ->with('status', 'Participant deleted.');
    }
}
