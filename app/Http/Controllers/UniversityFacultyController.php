<?php

namespace App\Http\Controllers;

use App\Actions\University\StoreUniversityFacultyAction;
use App\Actions\University\UpdateUniversityFacultyAction;
use App\DTO\University\UniversityFacultyDTO;
use App\Http\Requests\University\StoreUniversityFacultyRequest;
use App\Http\Requests\University\UpdateUniversityFacultyRequest;
use App\Models\UniversityFaculty;
use Illuminate\Http\JsonResponse;

class UniversityFacultyController extends Controller
{
    public function index(): JsonResponse
    {
        $faculties = UniversityFaculty::all();
        return response()->json($faculties);
    }

    public function store(StoreUniversityFacultyRequest $request, StoreUniversityFacultyAction $action): JsonResponse
    {
        $dto = UniversityFacultyDTO::from($request->validated());
        $faculty = $action->execute($dto);
        return response()->json($faculty, 201);
    }

    public function show(UniversityFaculty $faculty): JsonResponse
    {
        return response()->json($faculty);
    }

    public function update(UpdateUniversityFacultyRequest $request, UniversityFaculty $faculty, UpdateUniversityFacultyAction $action): JsonResponse
    {
        $dto = UniversityFacultyDTO::from($request->validated());
        $faculty = $action->execute($faculty, $dto);
        return response()->json($faculty);
    }

    public function destroy(UniversityFaculty $faculty): JsonResponse
    {
        $faculty->delete();
        return response()->json(null, 204);
    }
} 