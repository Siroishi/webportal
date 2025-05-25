<?php

namespace App\Actions\News;

use App\DTO\News\NewsDTO;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateNewsAction
{
    public function execute(News $news, NewsDTO $dto): News
    {
        $imagePath = $news->image;
        if ($dto->image) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $imagePath = $dto->image->store('news', 'public');
        }

        $news->update([
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