<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormController extends Controller
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
        'project_id'  => ['nullable','exists:projects,id'],
        'code'        => ['required','string','max:100','unique:forms,code'],
        'name'        => ['required','string'],
        'description' => ['nullable','string'],
        'definition'  => ['required','array'], // contains fields and constraints
    ]);

    $form = Form::create($data);

    return response()->json($form, 201);
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
