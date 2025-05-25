<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\UniversityFaculty;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UniversityFacultyRelationController extends Controller
{
    public function attach(Request $request, University $university): JsonResponse
    {
        $request->validate([
            'faculty_ids' => ['required', 'array'],
            'faculty_ids.*' => ['exists:university_faculties,id'],
        ]);

        $university->faculties()->attach($request->faculty_ids);
        return response()->json($university->load('faculties'));
    }

    public function detach(Request $request, University $university): JsonResponse
    {
        $request->validate([
            'faculty_ids' => ['required', 'array'],
            'faculty_ids.*' => ['exists:university_faculties,id'],
        ]);

        $university->faculties()->detach($request->faculty_ids);
        return response()->json($university->load('faculties'));
    }

    public function sync(Request $request, University $university): JsonResponse
    {
        $request->validate([
            'faculty_ids' => ['required', 'array'],
            'faculty_ids.*' => ['exists:university_faculties,id'],
        ]);

        $university->faculties()->sync($request->faculty_ids);
        return response()->json($university->load('faculties'));
    }
} 