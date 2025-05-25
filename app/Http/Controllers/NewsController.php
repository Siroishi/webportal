<?php

namespace App\Http\Controllers;

use App\Actions\News\CreateNewsAction;
use App\Actions\News\UpdateNewsAction;
use App\DTO\News\NewsDTO;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function __construct(
        private readonly CreateNewsAction $createNewsAction,
        private readonly UpdateNewsAction $updateNewsAction
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = News::query()->with('categories');

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

        $news = $query->latest()->paginate(10);

        return view('news.index', compact('news'));
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
    public function store(StoreNewsRequest $request, StoreNewsAction $action): JsonResponse
    {
        $dto = NewsDTO::from($request->validated());
        $news = $action->execute($dto);
        return response()->json($news, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news): View
    {
        $news->load('categories');
        return view('news.show', compact('news'));
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
    public function update(UpdateNewsRequest $request, News $news, UpdateNewsAction $action): JsonResponse
    {
        $dto = NewsDTO::from($request->validated());
        $news = $action->execute($news, $dto);
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
