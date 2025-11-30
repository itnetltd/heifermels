<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function overview(Request $request)
{
    $projectId = $request->query('project_id');

    $participantsCount = Participant::when($projectId, fn($q) => $q->where('project_id', $projectId))->count();

    $submissionsCount = Submission::when($projectId, fn($q) => $q->where('project_id', $projectId))->count();

    $byGender = Participant::when($projectId, fn($q) => $q->where('project_id', $projectId))
        ->select('gender', DB::raw('count(*) as total'))
        ->groupBy('gender')
        ->get();

    return response()->json([
        'participants_total' => $participantsCount,
        'submissions_total'  => $submissionsCount,
        'participants_by_gender' => $byGender,
    ]);
}

}

