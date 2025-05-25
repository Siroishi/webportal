<?php

namespace App\Http\Controllers;

use App\Actions\Knowledge\CreateKnowledgeAction;
use App\Actions\Knowledge\UpdateKnowledgeAction;
use App\DTO\Knowledge\KnowledgeDTO;
use App\Http\Requests\Knowledge\StoreKnowledgeRequest;
use App\Http\Requests\Knowledge\UpdateKnowledgeRequest;
use App\Models\Knowledge;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class KnowledgeController extends Controller
{
    public function __construct(
        private readonly CreateKnowledgeAction $createKnowledgeAction,
        private readonly UpdateKnowledgeAction $updateKnowledgeAction
    ) {}

    public function index(): JsonResponse
    {
        $knowledge = Knowledge::with('categories')->paginate(10);
        return response()->json($knowledge);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(StoreKnowledgeRequest $request): JsonResponse
    {
        $dto = KnowledgeDTO::fromRequest($request->validated());
        $knowledge = $this->createKnowledgeAction->execute($dto);
        return response()->json($knowledge, 201);
    }

    public function show(Knowledge $knowledge): JsonResponse
    {
        return response()->json($knowledge->load('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Knowledge $knowledge)
    {
        //
    }

    public function update(UpdateKnowledgeRequest $request, Knowledge $knowledge): JsonResponse
    {
        $dto = KnowledgeDTO::fromRequest($request->validated());
        $knowledge = $this->updateKnowledgeAction->execute($knowledge, $dto);
        return response()->json($knowledge);
    }

    public function destroy(Knowledge $knowledge): JsonResponse
    {
        if ($knowledge->image) {
            Storage::disk('public')->delete($knowledge->image);
        }
        $knowledge->delete();
        return response()->json(null, 204);
    }
}
