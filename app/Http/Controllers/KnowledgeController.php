<?php

namespace App\Http\Controllers;

use App\Actions\Knowledge\StoreKnowledgeAction;
use App\Actions\Knowledge\UpdateKnowledgeAction;
use App\DTO\Knowledge\KnowledgeDTO;
use App\Http\Requests\Knowledge\StoreKnowledgeRequest;
use App\Http\Requests\Knowledge\UpdateKnowledgeRequest;
use App\Models\Knowledge;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KnowledgeController extends Controller
{
    public function index(Request $request): View
    {
        $query = Knowledge::query()->with('categories');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->has('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('slug', $request->get('category'));
            });
        }

        $knowledge = $query->latest()->paginate(10);

        return view('knowledge.index', compact('knowledge'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(StoreKnowledgeRequest $request, StoreKnowledgeAction $action): JsonResponse
    {
        $dto = KnowledgeDTO::from($request->validated());
        $knowledge = $action->execute($dto);
        return response()->json($knowledge, 201);
    }

    public function show(Knowledge $knowledge): View
    {
        $knowledge->load('categories');
        return view('knowledge.show', compact('knowledge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Knowledge $knowledge)
    {
        //
    }

    public function update(UpdateKnowledgeRequest $request, Knowledge $knowledge, UpdateKnowledgeAction $action): JsonResponse
    {
        $dto = KnowledgeDTO::from($request->validated());
        $knowledge = $action->execute($knowledge, $dto);
        return response()->json($knowledge);
    }

    public function destroy(Knowledge $knowledge): JsonResponse
    {
        $knowledge->delete();
        return response()->json(null, 204);
    }
}
