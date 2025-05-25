<?php

namespace App\Actions\News;

use App\DTO\News\NewsDTO;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateNewsAction
{
    public function execute(NewsDTO $dto): News
    {
        $imagePath = null;
        if ($dto->image) {
            $imagePath = $dto->image->store('news', 'public');
        }

        $news = News::create([
            'title' => $dto->title,
            'slug' => Str::slug($dto->title),
            'content' => $dto->content,
            'image' => $imagePath,
            'is_published' => $dto->is_published,
            'published_at' => $dto->published_at
        ]);

        if ($dto->categories) {
            $news->categories()->sync($dto->categories);
        }

        return $news->load('categories');
    }
} 