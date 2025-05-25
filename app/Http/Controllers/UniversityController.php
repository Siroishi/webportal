<?php

namespace App\Http\Controllers;

use App\Actions\University\StoreUniversityAction;
use App\Actions\University\UpdateUniversityAction;
use App\DTO\University\UniversityDTO;
use App\Http\Requests\University\StoreUniversityRequest;
use App\Http\Requests\University\UpdateUniversityRequest;
use App\Models\University;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UniversityController extends Controller
{
    public function index(Request $request): View
    {
        $query = University::query()->with('faculties');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        if ($request->has('faculty')) {
            $query->whereHas('faculties', function($q) use ($request) {
                $q->where('slug', $request->get('faculty'));
            });
        }

        $universities = $query->latest()->paginate(10);

        return view('universities.index', compact('universities'));
    }

    public function store(StoreUniversityRequest $request, StoreUniversityAction $action): JsonResponse
    {
        $dto = UniversityDTO::from($request->validated());
        $university = $action->execute($dto);
        return response()->json($university, 201);
    }

    public function show(University $university): View
    {
        $university->load('faculties');
        return view('universities.show', compact('university'));
    }

    public function update(UpdateUniversityRequest $request, University $university, UpdateUniversityAction $action): JsonResponse
    {
        $dto = UniversityDTO::from($request->validated());
        $university = $action->execute($university, $dto);
        return response()->json($university);
    }

    public function destroy(University $university): JsonResponse
    {
        $university->delete();
        return response()->json(null, 204);
    }
} 