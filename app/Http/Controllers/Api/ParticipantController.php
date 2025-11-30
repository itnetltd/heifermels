<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $query = Participant::query();

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        if ($request->filled('district')) {
            $query->where('district', $request->district);
        }

        return $query->paginate(25);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id'       => ['required','exists:projects,id'],
            'participant_uid'  => ['required','string','max:50','unique:participants,participant_uid'],
            'full_name'        => ['nullable','string','max:255'],
            'gender'           => ['nullable', Rule::in(['Male','Female','Other'])],
            'date_of_birth'    => ['nullable','date'],
            'phone'            => ['nullable','string','max:50'],
            'province'         => ['nullable','string','max:100'],
            'district'         => ['nullable','string','max:100'],
            'sector'           => ['nullable','string','max:100'],
            'cell'             => ['nullable','string','max:100'],
            'village'          => ['nullable','string','max:100'],
            'is_youth'         => ['boolean'],
            'is_person_with_disability' => ['boolean'],
            'additional_attributes' => ['array'],
        ]);

        $participant = Participant::create($data);

        return response()->json($participant, 201);
    }

    public function show(Participant $participant)
    {
        return $participant->load('organizations');
    }

    public function update(Request $request, Participant $participant)
    {
        $data = $request->validate([
            'project_id'       => ['sometimes','exists:projects,id'],
            'participant_uid'  => ['sometimes','string','max:50', Rule::unique('participants')->ignore($participant->id)],
            // same as store for other fields...
        ]);

        $participant->update($data);

        return $participant;
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();
        return response()->noContent();
    }
}
