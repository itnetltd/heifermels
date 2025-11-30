<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'form_id'       => ['required','exists:forms,id'],
        'project_id'    => ['nullable','exists:projects,id'],
        'participant_id'=> ['nullable','exists:participants,id'],
        'data'          => ['required','array'],
        'status'        => ['nullable','string'], // default submitted
    ]);

    $form = Form::findOrFail($data['form_id']);
    $definition = $form->definition;

    // TODO: dynamic validation based on $definition['fields']

    $submission = Submission::create([
        'form_id'               => $form->id,
        'project_id'            => $data['project_id'] ?? $form->project_id,
        'participant_id'        => $data['participant_id'] ?? null,
        'submitted_by_user_id'  => $request->user()->id,
        'status'                => $data['status'] ?? 'submitted',
        'submitted_at'          => now(),
        'data'                  => $data['data'],
        'metadata'              => [
            'user_agent' => $request->userAgent(),
            'ip'         => $request->ip(),
        ],
    ]);

    return response()->json($submission, 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
