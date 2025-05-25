<?php

namespace App\Http\Controllers;

use App\Actions\News\CreateNewsAction;
use App\Actions\News\UpdateNewsAction;
use App\DTO\News\NewsDTO;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function __construct(
        private readonly CreateNewsAction $createNewsAction,
        private readonly UpdateNewsAction $updateNewsAction
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $news = News::with('categories')->paginate(10);
        return response()->json($news);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request): JsonResponse
    {
        $dto = NewsDTO::fromRequest($request->validated());
        $news = $this->createNewsAction->execute($dto);
        return response()->json($news, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news): JsonResponse
    {
        return response()->json($news->load('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news): JsonResponse
    {
        $dto = NewsDTO::fromRequest($request->validated());
        $news = $this->updateNewsAction->execute($news, $dto);
        return response()->json($news);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news): JsonResponse
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();
        return response()->json(null, 204);
    }
}
